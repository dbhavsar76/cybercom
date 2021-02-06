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
        this.lastId = parseInt(localStorage.getItem('lastId')) ?? 0;
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

