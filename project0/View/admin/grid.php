<?php
$statuses = [
    Model_Admin::STATUS_DISABLED => ['Disabled', 'btn-danger'],
    Model_Admin::STATUS_ENABLED  => ['Enabled', 'btn-success']
];
$admins = $this->admins;
?>

<div class="container-fluid">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <p class="h2 d-inline">Admins</p>
        <a href="<?= Model_Core_UrlManager::getUrl('add', null, null, true) ?>" class="btn btn-success">Add Admin</a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Status</th>
                <th scope="col">Created Date</th>
                <th scope="col">Updated Date</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
<?php foreach ($admins as $admin) {
    $id = $admin->{$admin->getPrimaryKey()};
    [$status, $statusClass] = $statuses[$admin->status];
?>
            <tr>
                <td><?= $id ?></td>
                <td><?= $admin->name ?></td>
                <td><?= $admin->email ?></td>
                <td><a class="btn <?= $statusClass ?>" href="<?= Model_Core_UrlManager::getUrl('toggleStatus', NULL, [$admin->getPrimaryKey() => $id]) ?>"><?= $status ?></a></td>
                <td><?= $admin->createdDate ?></td>
                <td><?= $admin->updatedDate ?></td>
                <td>
                    <a href="<?= Model_Core_UrlManager::getUrl('edit', NULL, [$admin->getPrimaryKey() => $id]) ?>" class="btn btn-primary"><i class="fas fa-edit fa-fw"></i></a>
                    <a href="<?= Model_Core_UrlManager::getUrl('delete', NULL, [$admin->getPrimaryKey() => $id]) ?>" class="btn btn-danger"><i class="fas fa-trash fa-fw"></i></a>
                </td>
            </tr>
<?php } ?>
        </tbody>
    </table>
</div>