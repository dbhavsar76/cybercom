window.addEventListener('load', function(e) {
    document.getElementById('submit-btn').addEventListener('click', function(e) {
        e.returnValue = validateForm();
    });
});

function validateForm() {
    const name = document.getElementById('name');
    const email = document.getElementById('email');
    const password = document.getElementById('password');
    const password2 = document.getElementById('password2');
    const birthdate = document.getElementById('birthdate');
    let validated = true;

    if (!name.value) {
        validated = invalidate(name);
    } else {
        validate(name);
    }

    if (!email.value) {
        validated = invalidate(email);
    } else {
        validate(email);
    }

    if (!password.value || password.value != password2.value) {
        validated = invalidate(password);
        validated = invalidate(password2);
    } else {
        validate(password);
        validate(password2);
    }

    if (!birthdate.value) {
        validated = invalidate(birthdate);
    } else if (isNaN((new Date(birthdate.value)).getFullYear())) {
        validated = invalidate(birthdate);
    } else {
        validate(birthdate);
    }

    return validated;
}

function validate(element) {
    element.classList.remove('error');
}

function invalidate(element) {
    element.classList.add('error');
    return false;
}