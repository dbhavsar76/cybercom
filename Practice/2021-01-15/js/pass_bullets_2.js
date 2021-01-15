// There are many cases to handle here so experimenting right now
// will be done by tommorow

document.getElementById('pass-placeholder').addEventListener('input', e => {
    console.log(e);
});

// on submit shows the entered password and cancels submission
document.getElementById('frm').addEventListener('submit', e => {
    alert(document.getElementById('password').value);
    return false;
})