window.addEventListener('load', function(e) {
    document.getElementById('categories-table').addEventListener('click', function(e) {
        if (e.target.classList.contains('delete')) {
            e.preventDefault();
            const id = e.target.dataset.id;
            let req = new XMLHttpRequest();

            req.onreadystatechange = function () {
                if (req.readyState == 4 && req.status == 200) {
                    if (req.responseText == 'success') {
                        deleteTableRow(id);
                    }
                }
            }

            const param = `id=${id}`;
            req.open('POST', `delete_category.php`, true);
            req.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            req.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            req.send(param);
        }
    })
});

function deleteTableRow(id) {
    const tbody = document.getElementById('categories-table');

    for (const row of tbody.rows) {
        if (row.children[0].innerHTML == id) {
            tbody.removeChild(row);
            break;
        }
    }
}