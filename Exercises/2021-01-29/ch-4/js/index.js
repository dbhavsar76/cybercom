

// stop form from submitting
document.getElementById('frm').addEventListener('submit', function(event) {
    event.preventDefault();
    event.returnValue = false;
});


// add info functionality
document.getElementById('submit-btn').addEventListener('click', function(event) {
    let name = document.getElementById('name').value;
    let email = document.getElementById('email').value;
    let dob = document.getElementById('dob').value;
    let msg = document.getElementById('msg');
    
    if (!name || !email || !dob) {
        msg.innerHTML = 'Failed! Please enter information properly.';
        setTimeout(() => {
            msg.innerHTML = '';
        }, 5000);
    } else {
        persons.push(new Person(name, email, dob));
        localStorage.setItem('persons2', JSON.stringify(persons));
        msg.innerHTML = 'Added Successfully!';
        setTimeout(() => {
            msg.innerHTML = '';
        }, 5000);
    }
});