// attaching listener that validates inputs on submit event
document.getElementById('user-form').addEventListener('submit', function(e) {
    e.returnValue = validateForm();
});

// function takes every inputs and validates them
// - if an input is not validated its outline turns red
//   if successfully validated after correcting then reset back the outline
function validateForm() {
    
    // get all input elements
    const name = document.getElementById('name');
    const password = document.getElementById('password');
    const address = document.getElementById('address');
    const games = document.getElementsByName('game[]');
    const genders = document.getElementsByName('gender');
    const ageGrp = document.getElementById('age-grp');
    const imgUpload = document.getElementById('img-upload');
    const errors = document.querySelectorAll('.err-msg');
    let validated = true;

    // validating name
    // if element not found or empty value provided then show error
    // the (?.) operator ensures that if variable is not null 
    // then only access its member otherwise return undefined
    if (!name?.value) {
        validated = false;
        name?.classList.add('error');
        errors[0].innerHTML = '* Name is Required.';
    } else {
        name.classList.remove('error');
        errors[0].innerHTML = '';
    }

    // validating password
    if (!password?.value) {
        validated = false;
        password?.classList.add('error');
        errors[1].innerHTML = '* Password is Required.';
    } else {
        password.classList.remove('error');
        errors[1].innerHTML = '';
    }

    // validate address for empty value
    if (!address?.value) {
        validated = false;
        address?.classList.add('error');
        errors[2].innerHTML = '* Address is Required.';
    } else {
        address.classList.remove('error');
        errors[2].innerHTML = '';
    }
    
    // check every checkboxes
    // if not a single checkbox is checked then show error
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
            errors[3].innerHTML = '* Atleast One game is required.';
        } else {
            games.forEach(el => {
                el.classList.remove('error');
            });
            errors[3].innerHTML = '';
        }
    }

    // validating gender
    // if no radio btn is checked then show error
    if (!(genders?.[0].checked || genders?.[1].checked)) {
        validated = false;
        genders?.forEach(el => {
            el.classList.add('error');
        });
        errors[4].innerHTML = '* Gender is Required.';
    } else {
        genders.forEach(el => {
            el.classList.remove('error');
        });
        errors[4].innerHTML = '';
    }

    // validating age group
    if (!ageGrp?.value) {
        validated = false;
        ageGrp?.classList.add('error');
        errors[5].innerHTML = '* Age group is required.';
    } else {
        ageGrp.classList.remove('error');
        errors[5].innerHTML = '';
    }

    // validating image upload by file extension
    if (!imgUpload?.value) {
        validated = false;
        errors[6].innerHTML = '* File upload is Required.';
    }
    else if (!validateImageUpload(imgUpload.value)) {
        validated = false;
        imgUpload.classList.add('error');
        errors[6].innerHTML = '* Invalid File. Expected formats are jpeg, jpg, png';
    } else {
        imgUpload.classList.remove('error');
        errors[6].innerHTML = '';
    }

    return validated;
}

// for validating uploaded file extension
function validateImageUpload(fileName) {
    if (!fileName) {
        return false;
    }

    var allowed_extensions = ['jpeg','jpg','png'];
    var file_extension = fileName.split('.').pop().toLowerCase(); 
    // split function will split the filename by dot(.), 
    // and pop function will pop the last element from the array which will give you the extension as well. 
    // If there will be no extension then it will return the filename.

    for(var i = 0; i <= allowed_extensions.length; i++) {
        if(allowed_extensions[i]==file_extension) {
            return true; // valid file extension
        }
    }

    return false;
}