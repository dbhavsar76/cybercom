// yes, i didn't use 'required' attribute in html
// and i thought about backend validation also
// but since there isn't explicit mention of that,
// i ignored it to save some time

// js file of every form is almost same (same for html and php files)
// subsequent files may not be fully documented

// attaching listener that validates inputs on submit event
document.getElementById('user-form').addEventListener('submit', function(e) {
    e.returnValue = validateForm();
});

// function takes every inputs and validates them
// - if an input is not validated its outline turns red
//   if successfully validated after correcting then reset back the outline
// - for more user-friendliness i could also print various messages
//   next to every input based on validation error but it would 
//   make code way bigger and i had to do 5 forms in a day so...
function validateForm() {
    
    // get all input elements
    const name = document.getElementById('name');
    const password = document.getElementById('password');
    const address = document.getElementById('address');
    const games = document.getElementsByName('game[]');
    const genders = document.getElementsByName('gender');
    const ageGrp = document.getElementById('age-grp');
    const imgUpload = document.getElementById('img-upload');
    let validated = true;

    // validating name
    // if element not found or empty value provided then show error
    // the (?.) operator ensures that if variable is not null 
    // then only access its member otherwise return undefined
    if (!name?.value) {
        validated = false;
        name?.classList.add('error');
    } else {
        name?.classList.remove('error');
    }

    // validating gender
    // if no radio btn is checked then show error
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

    // validate address for empty value
    if (!address?.value) {
        validated = false;
        address?.classList.add('error');
    } else {
        address?.classList.remove('error');
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
        } else {
            games.forEach(el => {
                el.classList.remove('error');
            });
        }
    }

    // validating password
    if (!password?.value) {
        validated = false;
        password?.classList.add('error');
    } else {
        password?.classList.remove('error');
    }

    // validating age group
    if (!ageGrp?.value) {
        validated = false;
        ageGrp?.classList.add('error');
    } else {
        ageGrp?.classList.remove('error');
    }

    // validating image upload by file extension
    if (!validateImageUpload(imgUpload?.value)) {
        validated = false;
        imgUpload?.classList.add('error');
    } else {
        imgUpload?.classList.remove('error');
    }

    return validated;
}

// for validating uploaded file extension
function validateImageUpload(fileName) {
    if (!fileName) return false;

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