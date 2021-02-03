document.getElementById('user-form').addEventListener('submit', function(e) {
    e.returnValue = validateForm();
});

function validateForm() {
    const name = document.getElementById('name');
    const password = document.getElementById('password');
    const tnc = document.getElementById('tnc');
    const genders = document.getElementsByName('gender');
    const mStatus = document.getElementsByName('m-status');
    const dobDate = document.getElementById('dob-date');
    const dobMonth = document.getElementById('dob-month');
    const dobYear = document.getElementById('dob-year');
    const address = document.getElementById('address');
    const games = document.getElementsByName('game[]');
    const errors = document.querySelectorAll('.err-msg');
    let validated = true;

    if (!name?.value) {
        validated = false;
        name?.classList.add('error');
        errors[0].innerHTML = '* Name is Required.';
    } else {
        name.classList.remove('error');
        errors[0].innerHTML = '';
    }

    if (!password?.value) {
        validated = false;
        password?.classList.add('error');
        errors[1].innerHTML = '* Password is Required.';
    } else {
        password.classList.remove('error');
        errors[1].innerHTML = '';
    }

    if (!(genders?.[0].checked || genders?.[1].checked)) {
        validated = false;
        genders?.forEach(el => {
            el.classList.add('error');
        });
        errors[2].innerHTML = '* Gender is Required.';
    } else {
        genders.forEach(el => {
            el.classList.remove('error');
        });
        errors[2].innerHTML = '';
    }

    if (!address?.value) {
        validated = false;
        address?.classList.add('error');
        errors[3].innerHTML = '* Address is Required.';
    } else {
        address.classList.remove('error');
        errors[3].innerHTML = '';
    }

    if (!dobDate?.value || !dobMonth?.value || !dobYear?.value) {
        validated = false;
        dobDate?.classList.add('error');
        dobMonth?.classList.add('error');
        dobYear?.classList.add('error');
        errors[4].innerHTML = '* Invalid Date.';
    } else {
        dobDate.classList.remove('error');
        dobMonth.classList.remove('error');
        dobYear.classList.remove('error');
        errors[4].innerHTML = '';
    }

    let checked = false;
    if (!games) {
        validated = false;
    } else { 
        for (let i=0; i<games.length; i++) {
            if (games[i].checked) {
                checked = true;
                break;
            }
        }
        if (!checked) {
            games.forEach(el => {
                el.classList.add('error');
            });
            errors[5].innerHTML = '* Atleast one game is required.';
        } else {
            games.forEach(el => {
                el.classList.remove('error');
            });
            errors[5].innerHTML = '';
        }
    }

    if (!(mStatus?.[0].checked || mStatus?.[1].checked)) {
        validated = false;
        mStatus?.forEach(el => {
            el.classList.add('error');
        });
        errors[6].innerHTML = '* Marital Status is Required';
    } else {
        mStatus.forEach(el => {
            el.classList.remove('error');
        });
        errors[6].innerHTML = '';
    }

    if (!tnc?.checked) {
        validated = false;
        tnc?.classList.add('error');
        errors[7].innerHTML = '* You need to agree to TnC.';
    } else {
        tnc.classList.remove('error');
        errors[7].innerHTML = '';
    }

    return validated;
}