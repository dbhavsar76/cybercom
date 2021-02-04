document.getElementById('user-form').addEventListener('submit', function(e) {
    e.returnValue = validateForm();
});

function validateForm() {
    const emailRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    const phoneRegex = /^\+?([0-9]{2})\)?[-. ]?([0-9]{4})[-. ]?([0-9]{4})$/ ; // /^\d{10}$/;
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
    const errors = document.querySelectorAll('.err-msg');
    let validated = true;

    if (!firstname?.value) {
        validated = false;
        firstname?.classList.add('error');
        errors[0].innerHTML = '* First Name is required.';
    } else {
        firstname.classList.remove('error');
        errors[0].innerHTML = '';
    }

    if (!lastname?.value) {
        validated = false;
        lastname?.classList.add('error');
        errors[1].innerHTML = '* Last name is Required.';
    } else {
        lastname.classList.remove('error');
        errors[1].innerHTML = '';
    }

    if (!dobDate?.value || !dobMonth?.value || !dobYear?.value) {
        validated = false;
        dobDate?.classList.add('error');
        dobMonth?.classList.add('error');
        dobYear?.classList.add('error');
        errors[2].innerHTML = '* Invalid Date.';
    } else {
        dobDate?.classList.remove('error');
        dobMonth?.classList.remove('error');
        dobYear?.classList.remove('error');
        errors[2].innerHTML = '';
    }

    if (!(genders?.[0].checked || genders?.[1].checked)) {
        validated = false;
        genders?.forEach(el => {
            el.classList.add('error');
        });
        errors[3].innerHTML = '* Gender is Required';
    } else {
        genders?.forEach(el => {
            el.classList.remove('error');
        });
        errors[3].innerHTML = '';
    }

    if (!country?.value) {
        validated = false;
        country?.classList.add('error');
        errors[4].innerHTML = '* Country is Required.'
    } else {
        country?.classList.remove('error');
        errors[4].innerHTML = '';
    }

    if (!email?.value) {
        validated = false;
        email?.classList.add('error');
        errors[5].innerHTML = '* Email is Required.';
    } else {
        if (!emailRegex.test(email.value))
        {
            validated = false;
            email.classList.add('error');
            errors[5].innerHTML = '* Invalid Email Format.';
        }
        else {
            email.classList.remove('error');
            errors[5].innerHTML = '';
        }
    }

    if (!phone?.value) {
        validated = false;
        phone?.classList.add('error');
        errors[6].innerHTML = '* Phone is Required.';
    } else {
        if (!phoneRegex.test(phone.value))
        {
            validated = false;
            phone.classList.add('error');
            errors[6].innerHTML = '* Invalid Phone Number.';
        }
        else {
            phone.classList.remove('error');
            errors[6].innerHTML = '';
        }
    }

    if (!password?.value) {
        validated = false;
        password?.classList.add('error');
        errors[7].innerHTML = '* Password is Required.';
    } else {
        if (!password2.value || password.value != password2.value) {
            validated = false;
            password.classList.remove('error');
            password2.classList.add('error');
            errors[7].innerHTML = '';
            errors[8].innerHTML = '* Password does not match.';
        } else {
            password.classList.remove('error');
            password2.classList.remove('error');
            errors[7].innerHTML = '';
            errors[8].innerHTML = '';
        }
    }

    if (!tnc?.checked) {
        validated = false;
        tnc?.classList.add('error');
        errors[9].innerHTML = '* You need to agree to TnC.';
    } else {
        tnc.classList.remove('error');
        errors[9].innerHTML = '';
    }

    return validated;
}