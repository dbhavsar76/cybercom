
// stopping form from submitting
document.getElementById('user-form').addEventListener('submit', function(e) {
    e.preventDefault();
    e.returnValue = false;
});
