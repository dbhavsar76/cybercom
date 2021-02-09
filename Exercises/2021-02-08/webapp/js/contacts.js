window.addEventListener('load', function(e) {
    document.getElementById('contacts-table').addEventListener('click', function(e) {
        let target;
        if (e.target.nodeName == 'SPAN' && e.target.parentNode.classList.contains('delete')) {
            target = e.target.parentNode;
        } else if (e.target.classList.contains('delete')) {
            target = e.target;
        }
        if (target) {
            e.preventDefault();
            const id = target.dataset.id;
            let req = new XMLHttpRequest();

            req.onreadystatechange = function () {
                if (req.readyState == 4 && req.status == 200) {
                    if (req.responseText == 'success') {
                        deleteTableRow(id);
                    }
                }
            }

            const param = `id=${id}`;
            req.open('POST', `delete.php`, true);
            req.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            req.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            req.send(param);
        }
    })
});

function deleteTableRow(id) {
    const tbody = document.getElementById('contacts-table');

    for (const row of tbody.rows) {
        if (row.children[0].innerHTML == id) {
            tbody.removeChild(row);
            break;
        }
    }
}