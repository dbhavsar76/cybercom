
// stop form from submitting
document.getElementById('registration-form').addEventListener('submit', function(e) {
    e.preventDefault();
    e.returnValue = false;
});