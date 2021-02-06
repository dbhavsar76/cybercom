// onload stuff
window.addEventListener('load', function(e) {

    const username = sessionStorage.getItem('username');
    const usertype = sessionStorage.getItem('usertype');
    
    // if not logged in or not admin user then redirect to login
    if (!username || !usertype || usertype != 'admin') {
        sessionStorage.clear();
        location.href = 'login.html';
    }

    // if admin logged in, replace name and refresh user table
    document.querySelector('.greeting').innerHTML = `Hello, ${username}`;
    // refreshUserTable();
});


// user-form submit button functionality
document.getElementById('user-form-btn').addEventListener('click', function(e) {
    const mode = document.getElementById('mode');
    const id = document.getElementById('id');
    const name = document.getElementById('name');
    const email = document.getElementById('email');
    const password = document.getElementById('password');
    const birthdate = document.getElementById('birthdate');
    const errors = document.querySelectorAll('.err-msg');
    const emailRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    let validated = true;

    if (!name?.value) {
        validated = false;
        name?.classList.add('error');
        errors[0].innerHTML = '* Name is required';
    } else {
        name.classList.remove('error');
        errors[0].innerHTML = '';
    }

    if (!email?.value) {
        validated = false;
        email?.classList.add('error');
        errors[1].innerHTML = '* Email is required';
    } else if (!emailRegex.test(email?.value)) {
        validated = false;
        email?.classList.add('error');
        errors[1].innerHTML = '* Invalid Email Format';
    } else {
        email.classList.remove('error');
        errors[1].innerHTML = '';
    }

    if (!password?.value) {
        validated = false;
        password?.classList.add('error');
        errors[2].innerHTML = '* Password is required';
    } else {
        password.classList.remove('error');
        errors[2].innerHTML = '';
    }

    if (!birthdate?.value) {
        validated = false;
        birthdate?.classList.add('error');
        errors[3].innerHTML = '* Birthdate is required';
    } else {
        birthdate.classList.remove('error');
        errors[3].innerHTML = '';
    }

    if (validated) {
        if (mode?.value === 'add') {  
            liveStorage.users.push(
                new User(
                    name.value,
                    email.value,
                    password.value,
                    birthdate.value
                )
            );
            liveStorage.updateUsers();
            resetForm();
            // refreshUserTable();
        } else if (mode?.value === 'update') {

        }
    }
});


// stopping form from submitting
document.getElementById('user-form').addEventListener('submit', function(e) {
    e.preventDefault();
    e.returnValue = false;
});

function resetForm() {
    document.getElementById('mode').value = 'add';
    document.getElementById('id').value = '';
    document.getElementById('name').value = '';
    document.getElementById('email').value = '';
    document.getElementById('password').value = '';
    document.getElementById('birthdate').value = '';
    document.getElementById('user-form-btn').innerHTML = 'Add User';
    document.getElementById('form-title').innerHTML = 'Add User';
}
