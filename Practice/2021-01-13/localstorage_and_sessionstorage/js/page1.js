// on loading of the page
// check the storage if the name exists or not
// if the name exists then show greetings
// else show the login prompt
window.addEventListener('load', (event) => {
    var name = localStorage.getItem('name');
    var formDiv = document.getElementById('frm');
    var greetDiv = document.getElementById('greetings');

    if (name) {
        document.getElementById('user').innerHTML = name;
        greetDiv.classList.remove('hidden');
    } else {
        formDiv.classList.remove('hidden');
    }
});

// happens when 'Log In' button is clicked
// save the name in local storage and reload the page
document.getElementById('btn-log-in').addEventListener('click', (event) => {
    var name = document.getElementById('name').value;
    var error = document.getElementById('error');

    if (name) {
        localStorage.setItem('name', name);
        location.reload();
    } else {
        error.innerHTML = 'Error : Name field is empty.';
    }
});

document.getElementById('btn-log-out').addEventListener('click', (event) => {
    localStorage.removeItem('name');
    location.reload();
});

// just to cancel form submission
document.getElementById('btn-log-in').parentElement.onsubmit = () => false;