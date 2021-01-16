// There are many cases to handle here so experimenting right now
// will be done by tommorow

// on submit shows the entered password and cancels submission
document.getElementById('frm').addEventListener('submit', e => {
    alert(document.getElementById('password').value);
    return false;
})

// for the simple case when user only types password one way
// and never presses backspace or delete or cut or paste or select text etc..
// just straight forward type and submit without any mistakes....
document.getElementById('pass-placeholder').addEventListener('input', e => {
    console.log(e);
    var ip = document.getElementById('pass-placeholder');
    var pass = document.getElementById('password');

    pass.value += e.data;
    ip.value = '%'.repeat(ip.value.length);
});
