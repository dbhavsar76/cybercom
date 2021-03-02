<?php
$statuses = [
    Model_Category::STATUS_DISABLED => ['Disabled', 'btn-danger'],
    Model_Category::STATUS_ENABLED  => ['Enabled', 'btn-success']
];
$categories = $this->categories;
?>

<div class="container-fluid">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <p class="h2 d-inline">Categories</p>
        <a href="<?= Model_Core_UrlManager::getUrl('add', null, null, true) ?>" class="btn btn-success">Create Category</a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Status</th>
                <th scope="col">Description</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
<?php foreach ($categories as $category) {
    $id = $category->{$category->getPrimaryKey()};
    [$status, $statusClass] = $statuses[$category->status];
?>
            <tr>
                <td><?= $id ?></td>
                <td><?= $category->name ?></td>
                <td> <a class="btn <?= $statusClass ?>" href="<?= Model_Core_UrlManager::getUrl('toggleStatus', null, [$category->getPrimaryKey() => $id]) ?>"><?= $status ?></a></td>
                <td><?= $category->description ?></td>
                <td>
                    <a href="<?= Model_Core_UrlManager::getUrl('edit', null, [$category->getPrimaryKey() => $id]) ?>" class="btn btn-primary"><i class="fas fa-edit fa-fw"></i></a>
                    <a href="<?= Model_Core_UrlManager::getUrl('delete', null, [$category->getPrimaryKey() => $id]) ?>" class="btn btn-danger"><i class="fas fa-trash fa-fw"></i></a>
                </td>
            </tr>
<?php } ?>
        </tbody>
    </table>
</div>
