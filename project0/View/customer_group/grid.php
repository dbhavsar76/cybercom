<?php
$defaultStatus = [
    Model_CustomerGroup::DEFAULT => ['Default', 'btn-secondary disabled'],
    Model_CustomerGroup::NOT_DEFAULT => ['Make Default', 'btn-success']
];
$customerGroups = $this->customerGroups;
?>

<div class="container-fluid">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <p class="h2 d-inline">Customer Groups</p>
        <a href="#" onclick="mage.setUrl('<?= Model_Core_UrlManager::getUrl('add', null, null, true) ?>').resetParams().load()" class="btn btn-success">Create Customer Group</a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Default</th>
                <th scope="col">Created Date</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
<?php foreach ($customerGroups as $customerGroup) {
    $id = $customerGroup->{$customerGroup->getPrimaryKey()};
    [$status, $statusClass] = $defaultStatus[$customerGroup->default];
?>
            <tr>
                <td><?= $id ?></td>
                <td><?= $customerGroup->name ?></td>
                <td><a class="btn <?= $statusClass ?>" href="#" onclick="mage.setUrl('<?= Model_Core_UrlManager::getUrl('makeDefault', null, [$customerGroup->getPrimaryKey() => $id]) ?>').resetParams().load()"><?= $status ?></a></td>
                <td><?= $customerGroup->createdDate ?></td>
                <td>
                    <a href="#" onclick="mage.setUrl('<?= Model_Core_UrlManager::getUrl('edit', null, [$customerGroup->getPrimaryKey() => $id]) ?>').resetParams().load()" class="btn btn-primary"><i class="fas fa-edit fa-fw"></i></a>
                    <a href="#" onclick="mage.setUrl('<?= Model_Core_UrlManager::getUrl('delete', null, [$customerGroup->getPrimaryKey() => $id]) ?>').resetParams().load()" class="btn btn-danger"><i class="fas fa-trash fa-fw"></i></a>
                </td>
            </tr>
<?php } ?>
        </tbody>
    </table>
</div>
