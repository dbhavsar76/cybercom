
// stop the form from submitting
document.getElementById('login-form').addEventListener('submit', function(e) {
    e.preventDefault();
    e.returnValue = false;
});