// onload stuff
window.addEventListener('load', function(e) {

    const username = sessionStorage.getItem('username');
    const usertype = sessionStorage.getItem('usertype');
    const userbday = sessionStorage.getItem('userbday');
    
    // if not logged in or not subuser then redirect to login
    if (!username || !usertype || usertype != 'subuser') {
        if (usertype != 'subuser') {
            sessionStorage.setItem('sessionEnd', (new Date()).toLocaleString());
            Logger.addSession();
        }
        sessionStorage.clear();
        location.href = 'login.html';
    }

    // if admin logged in, replace name and refresh user table
    document.querySelector('.greeting').innerHTML = `Hello, ${username}`;

    const today = new Date();
    const bday = new Date(userbday);
    if (today.getDate() == bday.getDate() && today.getMonth() == bday.getMonth()) {
        document.querySelector('.birthday-msg').classList.remove('hidden');
    }
    document.querySelector('.loading-screen').style.display = 'none';
});


// logout button functionallity
document.getElementById('logout').addEventListener('click', function(e) {
    sessionStorage.setItem('sessionEnd', (new Date()).toLocaleString());
    Logger.addSession();
    sessionStorage.clear();
    location.href = 'login.html';
});

