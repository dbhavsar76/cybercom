<?php
use \Model\Core\UrlManager;

$statuses = [
    \Model\Admin::STATUS_DISABLED => ['Disabled', 'btn-danger'],
    \Model\Admin::STATUS_ENABLED  => ['Enabled', 'btn-success']
];
$admins = $this->admins;
?>

<div class="container-fluid">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <p class="h2 d-inline">Admins</p>
        <a href="javascript:void(0);" onclick="mage.setUrl('<?= UrlManager::getUrl('add', null, null, true) ?>').resetParams().load()" class="btn btn-success">Add Admin</a>
    </div>
    <table class="table">
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
        <?php if ($admins->count() == 0) : ?>
            <tr>
                <td class="text-center" colspan="7">No Records Found.</td>
            </tr>
        <?php else : ?>
            <?php foreach ($admins as $admin) :
                $id = $admin->{$admin->getPrimaryKey()};
                [$status, $statusClass] = $statuses[$admin->status];
            ?>
            <tr>
                <td><?= $id ?></td>
                <td><?= $admin->name ?></td>
                <td><?= $admin->email ?></td>
                <td><a class="btn <?= $statusClass ?>" href="javascript:void(0);" onclick="mage.setUrl('<?= UrlManager::getUrl('toggleStatus', NULL, [$admin->getPrimaryKey() => $id]) ?>').resetParams().load()"><?= $status ?></a></td>
                <td><?= $admin->createdDate ?></td>
                <td><?= $admin->updatedDate ?></td>
                <td>
                    <a href="javascript:void(0);" onclick="mage.setUrl('<?= UrlManager::getUrl('edit', NULL, [$admin->getPrimaryKey() => $id]) ?>').resetParams().load()" class="btn btn-primary"><i class="fas fa-edit fa-fw"></i></a>
                    <a href="javascript:void(0);" onclick="mage.setUrl('<?= UrlManager::getUrl('delete', NULL, [$admin->getPrimaryKey() => $id]) ?>').resetParams().load()" class="btn btn-danger"><i class="fas fa-trash fa-fw"></i></a>
                </td>
            </tr>
            <?php endforeach ?>
        <?php endif ?>
        </tbody>
    </table>
</div>