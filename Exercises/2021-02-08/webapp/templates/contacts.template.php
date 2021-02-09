<div class="wrapper">
    <h1>Contacts</h1>
    <hr>
    <div>
        <a class="create-btn" href="create.php">Create Contact</a>
        <div class="success-msg"><?= $msg ?></div>
    </div>
    <table>
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Title</th>
                <th scope="col">Created</th>
                <th scope="col">&nbsp;</th>
            </tr>
        </thead>
        <tbody id="contacts-table">
        <?php foreach ($contacts as $contact) : ?>
            <tr>
                <td><?= $contact['id'] ?></td>
                <td><?= $contact['name'] ?></td>
                <td><?= $contact['email'] ?></td>
                <td><?= $contact['phone'] ?></td>
                <td><?= $contact['title'] ?></td>
                <td><?= $contact['created'] ?></td>
                <td>
                    <a class="edit" href="update.php?id=<?= $contact['id'] ?>"><span class="material-icons">edit</span></a>
                    <a class="delete" data-id="<?= $contact['id'] ?>" href="#"><span class="material-icons">delete_forever</span></a>
                </td>
            </tr>
            <?php endforeach ?>
            <!-- <tr>
                <td>1</td>
                <td>John Doe</td>
                <td>johndoe@example.com</td>
                <td>1234567890</td>
                <td>Lawyer</td>
                <td>2021-02-21 21:21:21</td>
                <td>
                    <a class="edit" data-id="" href="update.php"><span class="material-icons">edit</span></a>
                    <a class="delete" data-id="" href="#"><span class="material-icons">delete_forever</span></a>
                </td>
            </tr> -->
            </tbody>
    </table>
</div>