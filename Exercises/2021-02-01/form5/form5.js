document.getElementById('sign-in-form').addEventListener('submit', function(e) {
    e.returnValue = validateForm();
});

function validateForm() {
    const emailRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    const email = document.getElementById('email');
    const password = document.getElementById('password');
    let validated = true;

    if (!email?.value) {
        validated = false;
        email?.classList.add('error');
    } else {
        if (!emailRegex.test(email.value))
        {
            validated = false;
            email.classList.add('error');
        }
        else {
            email.classList.remove('error');
        }
    }

    if (!password?.value) {
        validated = false;
        password?.classList.add('error');
    } else {
        password?.classList.remove('error');
    }

    return validated;
}