// pretty self explainatory by name
// keeps live objects of users storage and admin 

const liveStorage = {
    users: null,    // array
    admin: null,    // object
    refreshUsers: function() {
        // if there are no users init to empty array
        this.users = JSON.parse(localStorage.getItem('users')) ?? [];
    },
    updateUsers: function() { // update users in localStorage
        localStorage.setItem('users', JSON.stringify(this.users));
    },
    refreshAdmin: function() {
        // if admin is not registered then it stays null
        this.admin = JSON.parse(localStorage.getItem('admin'));
    },
    updateAdmin: function() { // update admin in localStorage
        localStorage.setItem('admin', JSON.stringify(this.admin));
    }
}
liveStorage.refreshAdmin();
liveStorage.refreshUsers();

// id provider
const ID = {
    lastId: 0,
    getNew: function() {
        localStorage.setItem('lastId', ++this.lastId);
        return this.lastId;
    },
    refreshId: function() {
        this.lastId = parseInt(localStorage.getItem('lastId')) || 0;
    }
}
ID.refreshId();

// user object constructor
class User {
    constructor(name, email, password, birthdate) {
        this.id = ID.getNew();
        this.name = name;
        this.email = email;
        this.password = password;
        this.birthdate = birthdate;
        const today = new Date();
        const bday = new Date(birthdate);
        this.age = today.getFullYear() - bday.getFullYear();
    }
}


// this function is only called when logout is clicked
// i don't know how to trigger it when window/tab is closed without clicking logout
// there is a window.onunload event but it triggers on link click, redirect, refresh, etc. so can't use it
const Logger = {
    logAdmin: false,            // set to True if you want to log the admin activity as well
    differentiateAdmin: false,  // set to True to see admin differently in logs (if logged)
    addSession: function() {
        const usertype = sessionStorage.getItem('usertype');
        const userid = sessionStorage.getItem('userid');
        const start = sessionStorage.getItem('sessionStart');
        const end = sessionStorage.getItem('sessionEnd');
        const username = sessionStorage.getItem('username');
        if (userid && start && end) {
            // comment below line to start logging admin's session data
            if (!this.logAdmin && usertype == 'admin') return;
            const sessions = this.getSessions();
            sessions.unshift({ // using unshift so recent one stays on top
                userid: userid, // storing user ids so that name changes in the log when updated in users panel.
                username: username, // also keep name if user is deleted
                sessionStart: start,
                sessionEnd: end
            });
            localStorage.setItem('sessions', JSON.stringify(sessions));
        }
    },
    getSessions: function() {
        return JSON.parse(localStorage.getItem('sessions')) ?? [];
    },
};

