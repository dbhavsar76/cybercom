document.getElementById('sign-in-form').addEventListener('submit', function(e) {
    e.returnValue = validateForm();
});

function validateForm() {
    const emailRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    const email = document.getElementById('email');
    const password = document.getElementById('password');
    const errors = document.querySelectorAll('.error-msg');
    let validated = true;

    if (!email?.value) {
        validated = false;
        email?.classList.add('error');
        errors[0].innerHTML = '* Email is Required.';
    } else {
        if (!emailRegex.test(email.value))
        {
            validated = false;
            email.classList.add('error');
            errors[0].innerHTML = '* Invalid Email Format.'
        }
        else {
            email.classList.remove('error');
            errors[0].innerHTML = '';
        }
    }

    if (!password?.value) {
        validated = false;
        password?.classList.add('error');
        errors[1].innerHTML = '* Password is Required.'
    } else {
        password?.classList.remove('error');
        errors[1].innerHTML = '';
    }

    return validated;
}