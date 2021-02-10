<div class="wrapper">
    <div>
        <h1>Blog Posts</h1>
        <a class="btn" href="<?= BASE_URL?>add_blogpost.php">Add Blog Post</a>
    </div>
    <table>
        <thead>
            <tr>
                <th scope="col">Post Id</th>
                <th scope="col">Category Name</th>
                <th scope="col">Title</th>
                <th scope="col">Published Date</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody id="blogpost-table">
<?php foreach($blogposts as $blogpost) : ?>
            <tr>
                <td><?= $blogpost['id'] ?></td>
                <td><?= $blogpost['categories'] ?></td>
                <td><?= $blogpost['title'] ?></td>
                <td><?= $blogpost['published'] ?></td>
                <td>
                    <a href="edit_blogpost.php?id=<?= $blogpost['id'] ?>">Edit</a>
                    <a href="#" class="delete" data-id="<?= $blogpost['id'] ?>">Delete</a>
                </td>
            </tr>
<?php endforeach ?>
        </tbody>
    </table>

</div>