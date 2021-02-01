document.getElementById('user-form').addEventListener('submit', function(e) {
    e.returnValue = validateForm();
});

function validateForm() {
    const emailRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    const phoneRegex = /^\d{10}$/;
    const firstname = document.getElementById('firstname');
    const lastname = document.getElementById('lastname');
    const email = document.getElementById('email');
    const phone = document.getElementById('phone');
    const password = document.getElementById('password');
    const password2 = document.getElementById('cnfrm-pswd');
    const tnc = document.getElementById('tnc');
    const genders = document.getElementsByName('gender');
    const dobDate = document.getElementById('dob-date');
    const dobMonth = document.getElementById('dob-month');
    const dobYear = document.getElementById('dob-year');
    const country = document.getElementById('country');
    let validated = true;

    if (!firstname?.value) {
        validated = false;
        firstname?.classList.add('error');
    } else {
        firstname?.classList.remove('error');
    }

    if (!lastname?.value) {
        validated = false;
        lastname?.classList.add('error');
    } else {
        lastname?.classList.remove('error');
    }

    if (!dobDate?.value || !dobMonth?.value || !dobYear?.value) {
        validated = false;
        dobDate?.classList.add('error');
        dobMonth?.classList.add('error');
        dobYear?.classList.add('error');
    } else {
        dobDate?.classList.remove('error');
        dobMonth?.classList.remove('error');
        dobYear?.classList.remove('error');
    }

    if (!(genders?.[0].checked || genders?.[1].checked)) {
        validated = false;
        genders?.forEach(el => {
            el.classList.add('error');
        });
    } else {
        genders?.forEach(el => {
            el.classList.remove('error');
        });
    }

    if (!country?.value) {
        validated = false;
        country?.classList.add('error');
    } else {
        country?.classList.remove('error');
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

    if (!phone?.value) {
        validated = false;
        phone?.classList.add('error');
    } else {
        if (!phoneRegex.test(phone.value))
        {
            validated = false;
            phone.classList.add('error');
        }
        else {
            phone.classList.remove('error');
        }
    }

    if (!password?.value) {
        validated = false;
        password?.classList.add('error');
    } else {
        if (!password2.value || password.value != password2.value) {
            validated = false;
            password2.classList.add('error');
        } else {
            password.classList.remove('error');
            password2.classList.remove('error');
        }
    }

    if (!tnc?.checked) {
        validated = false;
        tnc?.classList.add('error');
    } else {
        tnc.classList.remove('error');
    }

    return validated;
}