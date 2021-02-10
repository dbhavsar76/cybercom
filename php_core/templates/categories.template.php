<div class="wrapper">
    <div>
        <h1>Categories</h1>
        <a class="btn" href="<?= BASE_URL?>add_category.php">Add Category</a>
    </div>
    <table>
        <thead>
            <tr>
                <th scope="col">Category Id</th>
                <th scope="col">Category Image</th>
                <th scope="col">Category Name</th>
                <th scope="col">Created</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody id="categories-table">
<?php foreach($categories as $category) : ?>
            <tr>
                <td><?= $category['id'] ?></td>
                <td><img src="<?= 'img/category/'.$category['id'].'.png'?>" alt="<?= $category['id'] ?>" height="40"></td>
                <td><?= $category['title'] ?></td>
                <td><?= $category['created'] ?></td>
                <td>
                    <a href="edit_category.php?id=<?= $category['id'] ?>">Edit</a>
                    <a href="#" class="delete" data-id="<?= $category['id'] ?>">Delete</a>
                </td>
            </tr>
<?php endforeach ?>
            <!-- <tr>
                <td>1</td>
                <td>Blah, Blah</td>
                <td>Some Title</td>
                <td>10 10 1010 10:10:10</td>
                <td>
                    <a href="addedit_blogpost.php?mode=edit&id=1"></a>
                    <a href="#" data-id="1"></a>
                </td>
            </tr> -->
        </tbody>
    </table>

</div>