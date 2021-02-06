// onload stuff
window.addEventListener('load', function(e) {

    const username = sessionStorage.getItem('username');
    const usertype = sessionStorage.getItem('usertype');
    
    // if not logged in or not admin user then redirect to login
    if (!username || !usertype || usertype != 'admin') {
        if (usertype != 'admin') {
            sessionStorage.setItem('sessionEnd', (new Date()).toLocaleString());
            addSession();
        }
        sessionStorage.clear();
        location.href = 'login.html';
    }

    // if admin logged in, replace name and refresh user table
    document.querySelector('.greeting').innerHTML = `Hello, ${username}`;
    refreshUserTable();
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
    } else if (userAlreadyExists(email?.value, mode.value, id.value)) {
        validated = false;
        email.classList.add('error');
        errors[1].innerHTML = '* User email already exists';
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
    } else if (!isValidDate(birthdate.value)) {
        validated = false;
        birthdate?.classList.add('error');
        errors[3].innerHTML = '* Invalid Date';
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
            refreshUserTable();
        } else if (mode?.value === 'update') {
            const index = liveStorage.users.findIndex(user => user.id === parseInt(id.value));
            const user = liveStorage.users[index];
            user.name = name.value;
            user.email = email.value;
            user.password = password.value;
            user.birthdate = birthdate.value;
            const today = new Date();
            const bday = new Date(birthdate.value);
            user.age = today.getFullYear() - bday.getFullYear();
            liveStorage.updateUsers();
            resetForm();
            refreshUserTable();
        }
    }
});


// for action links
// since table is created dynamically, instead of attaching the
// listener to every row individually, use event bubbling and
// attach the listener to the table and capture the events there
document.getElementById('user-table').addEventListener('click', function(e) {
    // when edit link is clicked
    const index = liveStorage.users.findIndex(user => user.id === parseInt(e.target.dataset.id))
    if (e.target.innerHTML == 'Edit') {
        const user = liveStorage.users[index];
        document.getElementById('mode').value = 'update';
        document.getElementById('id').value = user.id;
        document.getElementById('name').value = user.name;
        document.getElementById('email').value = user.email;
        document.getElementById('password').value = user.password;
        document.getElementById('birthdate').value = user.birthdate;
        document.getElementById('user-form-btn').innerHTML = 'Update User';
        document.getElementById('form-title').innerHTML = 'Update User';
    } // when delete link is clicked
    else if (e.target.innerHTML == 'Delete') {
        liveStorage.users.splice(index, 1);
        liveStorage.updateUsers();
        refreshUserTable();
    }
});

// logout button functionallity
document.getElementById('logout').addEventListener('click', function(e) {
    sessionStorage.setItem('sessionEnd', (new Date()).toLocaleString());
    addSession();
    sessionStorage.clear();
    location.href = 'login.html';
});


// stopping form from submitting
document.getElementById('user-form').addEventListener('submit', function(e) {
    e.preventDefault();
    e.returnValue = false;
});


// dynamically create or update the table
function refreshUserTable() {
    const tbody = document.getElementById('user-table-content');

    // remove all rows
    while (tbody.rows.length) tbody.deleteRow(0);

    // build all rows fresh
    liveStorage.users.forEach(user => {
        const tr = tbody.insertRow();
        let td;

        // name
        td = tr.insertCell();
        td.innerHTML = user.name;

        // email
        td = tr.insertCell();
        td.innerHTML = `<a href="mailto:${user.email}">${user.email}</a>`;

        // password
        td = tr.insertCell();
        td.innerHTML = user.password;

        // birthdate
        td = tr.insertCell();
        td.innerHTML = user.birthdate;

        // age
        td = tr.insertCell();
        td.innerHTML = user.age;

        // actions
        td = tr.insertCell();
        td.innerHTML = `<a href="#" data-id="${user.id}">Edit</a> 
                        <a href="#" data-id="${user.id}">Delete</a>`;
    });
}

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

function isValidDate(date) {
    const today = new Date();
    const bday = new Date(date);
    if (isNaN(bday.getFullYear())) return false;
    const age = today.getFullYear() - bday.getFullYear();
    if (age < 0 || age > 120) return false;
    return true;
}


// checks if user email already exists 
function userAlreadyExists(email, mode = 'add', id = '') {
    if (!email) return false;
    if (mode == 'add') {
        if (liveStorage.admin?.email == email) return true;
        for (const user of liveStorage.users) {
            if (user.email == email) {
                return true;
            }
        }
    } else if (mode == 'update') {
        if (liveStorage.admin?.email == email) return true;
        for (const user of liveStorage.users) {
            if (user.email == email && user.id != id) {
                return true;
            }
        }
    }
    return false;
}