// onload stuff
window.addEventListener('load', function(e) {

    const username = sessionStorage.getItem('username');
    const usertype = sessionStorage.getItem('usertype');
    
    // if not logged in or not admin user then redirect to login
    if (!username || !usertype || usertype != 'admin') {
        if (usertype != 'admin') {
            sessionStorage.setItem('sessionEnd', (new Date()).toLocaleString());
            addSession();
        }
        sessionStorage.clear();
        location.href = 'login.html';
    }

    // if admin logged in, replace name and refresh user table
    document.querySelector('.greeting').innerHTML = `Hello, ${username}`;
    refreshSessionsTable();
    document.querySelector('.loading-screen').style.display = 'none';
});


// logout button functionallity
document.getElementById('logout').addEventListener('click', function(e) {
    sessionStorage.setItem('sessionEnd', (new Date()).toLocaleString());
    addSession();
    sessionStorage.clear();
    location.href = 'login.html';
});


function refreshSessionsTable() {
    const tbody = document.getElementById('user-table-content');
    const sessions = JSON.parse(localStorage.getItem('sessions')) ?? [];

    sessions.forEach(session => {
        const tr = tbody.insertRow();
        let td;

        td = tr.insertCell();
        if (session.userid == -1)
            td.innerHTML = liveStorage.admin.name;
        else
            td.innerHTML = liveStorage.users.find(user => user.id == session.userid).name;
        
        td = tr.insertCell();
        td.innerHTML = session.sessionStart;

        td = tr.insertCell();
        td.innerHTML = session.sessionEnd;
    });
}