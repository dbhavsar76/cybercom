// everything is same as page1.js but with sessionStorage instead of localStorage

window.addEventListener('load', (event) => {
    var name = sessionStorage.getItem('name');
    var formDiv = document.getElementById('frm');
    var greetDiv = document.getElementById('greetings');

    if (name) {
        document.getElementById('user').innerHTML = name;
        greetDiv.classList.remove('hidden');
    } else {
        formDiv.classList.remove('hidden');
    }
});

document.getElementById('btn-log-in').addEventListener('click', (event) => {
    var name = document.getElementById('name').value;
    var error = document.getElementById('error');

    if (name) {
        sessionStorage.setItem('name', name);
        location.reload();
    } else {
        error.innerHTML = 'Error : Name field is empty.';
    }
});

document.getElementById('btn-log-out').addEventListener('click', (event) => {
    sessionStorage.removeItem('name');
    location.reload();
});

document.getElementById('btn-log-in').parentElement.onsubmit = () => false;