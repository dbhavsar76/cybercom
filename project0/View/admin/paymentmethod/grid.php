<?php
use Model\Core\UrlManager;

$statuses = [
    \Model\PaymentMethod::STATUS_DISABLED => ['Disabled', 'btn-danger'],
    \Model\PaymentMethod::STATUS_ENABLED  => ['Enabled', 'btn-success']
];
$paymentMethods = $this->paymentMethods;
?>

<div class="container-fluid">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <p class="h2 d-inline">Payment Methods</p>
        <a href="#" onclick="mage.setUrl('<?= UrlManager::getUrl('add', null, null, true) ?>').resetParams().load()" class="btn btn-success">Create Payment Method</a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Code</th>
                <th scope="col">Description</th>
                <th scope="col">Status</th>
                <th scope="col">Created Date</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
<?php foreach ($paymentMethods as $paymentMethod) { 
        $id = $paymentMethod->{$paymentMethod->getPrimaryKey()};
        [$status,$statusClass] = $statuses[$paymentMethod->status];
?>
            <tr>
                <td><?= $id ?></td>
                <td><?= $paymentMethod->name ?></td>
                <td><?= $paymentMethod->code ?></td>
                <td><?= $paymentMethod->description ?></td>
                <td><a class="btn <?= $statusClass ?>" href="#" onclick="mage.setUrl('<?= UrlManager::getUrl('toggleStatus', null, [$paymentMethod->getPrimaryKey() => $id]) ?>').resetParams().load()"><?= $status ?></a></td>
                <td><?= $paymentMethod->createdDate ?></td>
                <td>
                    <a href="#" onclick="mage.setUrl('<?= UrlManager::getUrl('edit', NULL, [$paymentMethod->getPrimaryKey() => $id]) ?>').resetParams().load()" class="btn btn-primary"><i class="fas fa-edit fa-fw"></i></a>
                    <a href="#" onclick="mage.setUrl('<?= UrlManager::getUrl('delete', NULL, [$paymentMethod->getPrimaryKey() => $id]) ?>').resetParams().load()" class="btn btn-danger"><i class="fas fa-trash fa-fw"></i></a>
                </td>
            </tr>
<?php } ?>
        </tbody>
    </table>
</div>
