var persons = [];

persons.push({ firstName: 'Dhruv', lastName: 'Bhavsar', age: 20});
persons.push({ firstName: 'John', lastName: 'Smith', age: 13});
persons.push({ firstName: 'Tim', lastName: 'Arc', age: 25});
refreshTable();

// sort by first name
document.getElementById('sort-first-name').addEventListener('click', function(event) {
    persons.sort((a, b) => {
        let afn = a.firstName.toLowerCase();
        let bfn = b.firstName.toLowerCase();

        if (afn < bfn) return -1;
        else if (afn > bfn) return 1;
        else return 0;
    });
    refreshTable();
});


// sort by last name
document.getElementById('sort-last-name').addEventListener('click', function(event) {
    persons.sort((a, b) => {
        let aln = a.lastName.toLowerCase();
        let bln = b.lastName.toLowerCase();

        if (aln < bln) return -1;
        else if (aln > bln) return 1;
        else return 0;
    });
    refreshTable();
});


// sort by age
document.getElementById('sort-age').addEventListener('click', function(event) {
    persons.sort((a, b) => a.age - b.age);
    refreshTable();
});


// rebuild the table
function refreshTable() {
    let tbody = document.getElementById('content');
    if (!tbody) return;
    // remove all rows
    while (tbody.rows.length) {
        tbody.deleteRow(0);
    }

    // add new rows
    for (let person of persons) {
        let row = tbody.insertRow();
        let cell;

        // adding first name
        cell = row.insertCell();
        cell.innerHTML = person.firstName;

        // adding last name
        cell = row.insertCell();
        cell.innerHTML = person.lastName;

        // adding age
        cell = row.insertCell();
        cell.innerHTML = person.age;
    }
}