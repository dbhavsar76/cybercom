var persons;

// if there's already an array stored then load it else create new
function refreshArray() {
    let pstr = localStorage.getItem('persons');
    if (pstr) {
        persons = Person.parsePersons(pstr);
    } else {
        persons = [];
    }
}
refreshArray();


// on click of "show objects" button refresh the table
// im not keeping track of which are already present and which are not
// so im creating the whole table every time the load is clicked.

// refreshes the persons array and table
document.getElementById('load').addEventListener('click', function(event) {
    refreshArray();
    let tbody = document.getElementById('table-body');
    if (!tbody) return;

    // removing existing rows
    while (tbody.rows.length) {
        tbody.deleteRow(0);
    }

    // adding fresh rows
    for (let person of persons) {
        let row = tbody.insertRow();
        let cell;

        // adding name
        cell = row.insertCell();
        cell.innerHTML = person.name;

        // adding age
        cell = row.insertCell();
        cell.innerHTML = person.age;

        // adding email
        cell = row.insertCell();
        cell.innerHTML = person.email;

        // adding number
        cell = row.insertCell();
        cell.innerHTML = person.number;
    }
});


// add entries into the array and refresh local storage
document.getElementById('populate').addEventListener('click', function(event) {
    persons.push(new Person('Dhruv 1', 20, 'abc@xy.z', '9182736455'));
    persons.push(new Person('Dhruv 2', 21, 'def@xy.z', '9182736455'));
    persons.push(new Person('Dhruv 3', 22, 'ghi@xy.z', '9182736455'));
    persons.push(new Person('Dhruv 4', 23, 'jkl@xy.z', '9182736455'));
    localStorage.setItem('persons', JSON.stringify(persons));
});
