// to check for availability of localstorage
// when the page is loaded, i'm adding it to window.onload

window.addEventListener('load', (event) => {
    if (checkStorage()) {
        alert('Local Storage is available to use.');
    } else {
        alert('Local Storage is NOT available to use');
    }
});

// Alternative with ability to check both storages.

// window.addEventListener('load', (event) => {
//     var storage = 'localStorage';
//     if (storageAvailable(storage)) {
//         alert(`${storage} is available to use.<br>`);
//     } else {
//         alert(`${storage} is NOT available to use.<br>`);
//     }
//     storage = 'sessionStorage';
//     if (storageAvailable(storage)) {
//         alert(`${storage} is available to use.`);
//     } else {
//         alert(`${storage} is NOT available to use.`);
//     }
// });


// this here is the function i first made
function checkStorage() {
    var check = 'check';
    try {
        localStorage.setItem(check, check);
        localStorage.removeItem(check);
        return true;
    }
    catch (e) {
        return false; // this doesn't check for any specific cases
    }                 // just return false on any exception
}
// well, it only checks for localStorage
// but can check for both with the reference function

// here is the function i got to after doing more searches on the subject
function storageAvailable(type) {
    var storage;
    try {
        storage = window[type];
        var x = '__storage_test__';
        storage.setItem(x, x);
        storage.removeItem(x);
        return true;
    }
    catch(e) {
        return e instanceof DOMException && (
            // everything except Firefox
            e.code === 22 ||
            // Firefox
            e.code === 1014 ||
            // test name field too, because code might not be present
            // everything except Firefox
            e.name === 'QuotaExceededError' ||
            // Firefox
            e.name === 'NS_ERROR_DOM_QUOTA_REACHED') &&
            // acknowledge QuotaExceededError only if there's something already stored
            (storage && storage.length !== 0);
    }
}