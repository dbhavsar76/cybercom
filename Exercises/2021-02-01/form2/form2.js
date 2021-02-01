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
    let validated = true;

    if (!name?.value) {
        validated = false;
        name?.classList.add('error');
    } else {
        name?.classList.remove('error');
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

    if (!(mStatus?.[0].checked || mStatus?.[1].checked)) {
        validated = false;
        mStatus?.forEach(el => {
            el.classList.add('error');
        });
    } else {
        mStatus?.forEach(el => {
            el.classList.remove('error');
        });
    }

    if (!address?.value) {
        validated = false;
        address?.classList.add('error');
    } else {
        address?.classList.remove('error');
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
        } else {
            games.forEach(el => {
                el.classList.remove('error');
            });
        }
    }

    if (!password?.value) {
        validated = false;
        password?.classList.add('error');
    } else {
        password?.classList.remove('error');
    }

    if (!tnc?.checked) {
        validated = false;
        tnc?.classList.add('error');
    } else {
        tnc?.classList.remove('error');
    }

    return validated;
}