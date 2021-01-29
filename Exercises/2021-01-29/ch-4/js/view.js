refreshTable();

document.getElementById('refresh').addEventListener('click', (e) => {refreshTable(); } );

function refreshTable() {
    refreshArray();
    let tbody = document.getElementById('content');
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

        // adding email
        cell = row.insertCell();
        cell.innerHTML = person.email;

        // adding number
        cell = row.insertCell();
        cell.innerHTML = person.dob;
    }
}