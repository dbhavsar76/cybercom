// stuff that happens at beggining
window.addEventListener('load', function(e) {

    // if admin already registered hide form and show msg already registered.
    //  edit - rather than hiding the form, just remove it from the page, 
    //         so cant be accessed by changing css in dev tools
    if (liveStorage.admin) {
        // document.getElementById('registration-form').style.display = 'none';
        document.querySelector('.wrapper').removeChild(document.getElementById('registration-form'));
        document.getElementById('already-registered').style.display = 'block';
    }
    document.querySelector('.loading-screen').style.display = 'none';
});

// register button functionality
// validate form, create admin in livestorage and update localstorage
document.getElementById('register-button').addEventListener('click', function(e) {
    const name = document.getElementById('name');
    const email = document.getElementById('email');
    const pass = document.getElementById('password');
    const pass2 = document.getElementById('password-2');
    const state = document.getElementById('state');
    const city = document.getElementById('city');
    const tnc = document.getElementById('tnc');
    const errors = document.querySelectorAll('.err-msg');
    let validated = true;

    const emailRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    
    // ?. operator will return undefined if name (or other vars) is nullish
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
        errors[1].innerHTML = '* Name is required';
    } else if (!emailRegex.test(email?.value)) {
        validated = false;
        email?.classList.add('error');
        errors[1].innerHTML = '* Invalid email format';        
    } else {
        email.classList.remove('error');
        errors[1].innerHTML = '';
    }

    if (!pass?.value) {
        validated = false;
        pass?.classList.add('error');
        errors[2].innerHTML = '* Password is required';
    }  else {
        if (!pass2?.value || pass.value != pass2.value) {
            validated = false;
            pass.classList.remove('error');
            pass2.classList.add('error');
            errors[2].innerHTML = '';
            errors[3].innerHTML = '* Password does not match';
        } else {
            pass.classList.remove('error');
            pass2.classList.remove('error');
            errors[2].innerHTML = '';
            errors[3].innerHTML = '';
        }
    }

    if (!state?.value) {
        validated = false;
        state?.classList.add('error');
        errors[4].innerHTML = '* State is required';
    } else {
        state.classList.remove('error');
        errors[4].innerHTML = '';
    }

    if (!city?.value) {
        validated = false;
        city?.classList.add('error');
        errors[5].innerHTML = '* City is required';
    } else {
        city.classList.remove('error');
        errors[5].innerHTML = '';
    }

    if (!tnc?.checked) {
        validated = false;
        tnc?.classList.add('error');
        errors[6].innerHTML = '* You must agree to TnC';
    } else {
        tnc.classList.remove('error');
        errors[6].innerHTML = '';
    }

    // all inputs validated succesfully then create admin object
    // save in livestorage and localstorage and redirect to login
    if (validated) {
        liveStorage.admin = {
            name: name.value,
            email: email.value,
            password: pass.value,
            state: state.value,
            city: city.value
        };
        liveStorage.updateAdmin();
        window.location.href = 'login.html';
    }
});


// stop form from submitting
document.getElementById('registration-form').addEventListener('submit', function(e) {
    e.preventDefault();
    e.returnValue = false;
});