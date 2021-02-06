// things that happens when page is loaded
// like hiding the register button if already registerd
// redirect if already logged in
window.addEventListener('load', function(e) {

    // just like register page just remove from the tree
    if (liveStorage.admin) {
        // document.getElementById('reg-btn').style.display = 'none';
        document.getElementById('login-form').removeChild(document.getElementById('reg-btn'));
    }

    // check if already logged in
    const username = sessionStorage.getItem('username');
    const usertype = sessionStorage.getItem('usertype');
    if (username && usertype == 'admin') {
        location.href = 'dashboard.html';
    } else if (username && usertype == 'subuser') {
        location.href = 'subuser.html';
    }
    document.querySelector('.loading-screen').style.display = 'none';
});

// login button functionality
// validate fields and log in the user
document.getElementById('login-button').addEventListener('click', function(e) {
    const email = document.getElementById('email');
    const password = document.getElementById('password');
    const errorMsg = document.querySelector('.err-msg');
    let matched = false;

    if (!email?.value || !password?.value) {
        errorMsg.innerHTML = 'Please fill all fields.';
        email.classList.add('error');
        password.classList.add('error');
    }
    // check if user is admin
    else if (email.value == liveStorage.admin?.email && password.value == liveStorage.admin?.password) {
        matched = true;
        sessionStorage.setItem('userid', -1);
        sessionStorage.setItem('username', liveStorage.admin.name);
        sessionStorage.setItem('usertype', 'admin');
        sessionStorage.setItem('sessionStart', (new Date()).toLocaleString());
        location.href = 'dashboard.html';
    }
    // check for sub-users
    else {
        for (const user of liveStorage.users) {
            if (user.email == email.value && user.password == password.value) {
                matched = true;
                sessionStorage.setItem('userid', user.id);
                sessionStorage.setItem('username', user.name);
                sessionStorage.setItem('usertype', 'subuser');
                sessionStorage.setItem('userbday', user.birthdate);
                sessionStorage.setItem('sessionStart', (new Date()).toLocaleString());
                location.href = 'subuser.html';
                break;
            }
        }
    }

    // if didn't redirect from either of them
    if (!matched) {
        errorMsg.innerHTML = 'Email or Password is Incorrect.';
        email.classList.add('error');
        password.classList.add('error');
    }
});

// register button functionality
document.getElementById('register-button').addEventListener('click', function(e) {
    location.href = 'register.html';
});

// stop the form from submitting
document.getElementById('login-form').addEventListener('submit', function(e) {
    e.preventDefault();
    e.returnValue = false;
});