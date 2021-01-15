// There are many cases to handle here so experimenting right now
// will be done by tommorow

document.getElementById('pass-placeholder').addEventListener('keyup', e => {
    console.log(e.target.selectionStart);
});

// on submit shows the entered password and cancels submission
document.getElementById('frm').addEventListener('submit', e => {
    alert(document.getElementById('password').value);
    return false;
})