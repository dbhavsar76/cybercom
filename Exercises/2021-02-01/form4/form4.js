document.getElementById('contact-form').addEventListener('submit', function(e) {
    e.returnValue = validateForm();
});

function validateForm() {
    const emailRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    const name = document.getElementById('name');
    const email = document.getElementById('email');
    const subject = document.getElementById('subject');
    const message = document.getElementById('message');
    let validated = true;

    if (!name?.value) {
        validated = false;
        name?.classList.add('error');
    } else {
        name.classList.remove('error');
    }

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

    if (!subject?.value) {
        validated = false;
        subject?.classList.add('error');
    } else {
        subject.classList.remove('error');
    }

    if (!message?.value) {
        validated = false;
        message?.classList.add('error');
    } else {
        message.classList.remove('error');
    }

    return validated;
}