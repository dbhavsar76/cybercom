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
    handleUserAgeGroups();
    handleUserBirthdays();
});


// logout button functionallity
document.getElementById('logout').addEventListener('click', function(e) {
    sessionStorage.setItem('sessionEnd', (new Date()).toLocaleString());
    addSession();
    sessionStorage.clear();
    location.href = 'login.html';
});


// count users in age groups
function handleUserAgeGroups() {
    let ageGrp1 = 0;
    let ageGrp2 = 0;
    let ageGrp3 = 0;

    liveStorage.users.forEach(user => {
        if (user.age < 18) ageGrp1++;
        else if (user.age < 51) ageGrp2++;
        else ageGrp3++;
    });

    const ageGrpElements = document.querySelectorAll('.age-group-content');
    ageGrpElements[0].innerHTML = `${ageGrp1} Users`;
    ageGrpElements[1].innerHTML = `${ageGrp2} Users`;
    ageGrpElements[2].innerHTML = `${ageGrp3} Users`;
}

function handleUserBirthdays() {
    const list = document.getElementById('birthdays');
    const today = new Date();
    liveStorage.users.forEach(user => {
        const bday = new Date(user.birthdate);
        if (bday.getDate() == today.getDate() && bday.getMonth() == today.getMonth()) {
            const li = document.createElement('li');
            li.innerHTML = `Today is '${user.name}' Birthday.`;
            list.appendChild(li);
        }
    });
}