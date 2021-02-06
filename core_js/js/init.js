// pretty self explainatory by name
// keeps live objects of users storage and admin 

const liveStorage = {
    users: null,    // array
    admin: null,    // object
    refreshUsers: function() {
        // if there are no users init to empty array
        this.users = JSON.parse(localStorage.getItem('users')) ?? [];
    },
    updateUsers: function() {
        localStorage.setItem('users', JSON.stringify(this.users));
    },
    refreshAdmin: function() {
        // if admin is not registered then it stays null
        this.admin = JSON.parse(localStorage.getItem('admin'));
    },
    updateAdmin: function() {
        localStorage.setItem('admin', JSON.stringify(this.admin));
    }
}
liveStorage.refreshAdmin();
liveStorage.refreshUsers();
