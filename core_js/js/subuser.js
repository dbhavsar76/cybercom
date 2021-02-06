// onload stuff
window.addEventListener('load', function(e) {

    const username = sessionStorage.getItem('username');
    const usertype = sessionStorage.getItem('usertype');
    const userbday = sessionStorage.getItem('userbday');
    
    // if not logged in or not  subuser then redirect to login
    if (!username || !usertype || usertype != 'subuser') {
        sessionStorage.clear();
        location.href = 'login.html';
    }

    document.querySelector('.greeting').innerHTML = `Hello, ${username}`;

    const today = new Date();
    const bday = new Date(userbday);
    if (today.getDate() == bday.getDate() && today.getMonth() == bday.getMonth()) {
        document.querySelector('.birthday-msg').classList.remove('hidden');
    }
});

