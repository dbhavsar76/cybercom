// onload stuff
window.addEventListener('load', function(e) {

    // if not logged in or not admin user then redirect to login
    const username = sessionStorage.getItem('username');
    const usertype = sessionStorage.getItem('usertype');

    if (!username || !usertype || usertype != 'admin') {
        sessionStorage.clear();
        location.href = 'login.html';
    }

    // if admin logged in, replace name and refresh user table
    document.querySelector('.greeting').innerHTML = `Hello, ${username}`;
    // refreshSessionsTable();
});

