document.getElementById('contact-form').addEventListener('submit', function(e) {
    e.returnValue = validateForm();
});

function validateForm() {
    const emailRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    const name = document.getElementById('name');
    const email = document.getElementById('email');
    const subject = document.getElementById('subject');
    const message = document.getElementById('message');
    const errors = document.querySelectorAll('.error-msg');
    let validated = true;

    if (!name?.value) {
        validated = false;
        name?.classList.add('error');
        errors[0].innerHTML = '* Name is Required.';

    } else {
        name.classList.remove('error');
        errors[0].innerHTML = '';
    }

    if (!email?.value) {
        validated = false;
        email?.classList.add('error');
        errors[1].innerHTML = '* Email is Required.';
    } else {
        if (!emailRegex.test(email.value))
        {
            validated = false;
            email.classList.add('error');
            errors[1].innerHTML = '* Invalid Email Format.';
        }
        else {
            email.classList.remove('error');
            errors[1].innerHTML = '';
        }
    }

    if (!subject?.value) {
        validated = false;
        subject?.classList.add('error');
        errors[2].innerHTML = '* Subject is Required.'
    } else if (subject?.value.length > 128) {
        validated = false;
        subject?.classList.add('error');
        errors[2].innerHTML = '* Subject length excecded 128 characters.';
    } else {
        subject.classList.remove('error');
        errors[2].innerHTML = '';
    }

    if (!message?.value) {
        validated = false;
        message?.classList.add('error');
        errors[3].innerHTML = '* Messege is Required.';
    } else {
        message.classList.remove('error');
        errors[3].innerHTML = '';
    }

    return validated;
}