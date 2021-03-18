<?php
use Model\Core\UrlManager;

$statuses = [
    \Model\ShippingMethod::STATUS_DISABLED => ['Disabled', 'btn-danger'],
    \Model\ShippingMethod::STATUS_ENABLED  => ['Enabled', 'btn-success']
];
$shippingMethods = $this->shippingMethods;
?>

<div class="container-fluid">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <p class="h2 d-inline">Shipping Methods</p>
        <a href="javascript:void(0);" onclick="mage.setUrl('<?= UrlManager::getUrl('add', null, null, true) ?>').resetParams().load()" class="btn btn-success">Create Shipping Method</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Code</th>
                <th scope="col">Amount</th>
                <th scope="col">Description</th>
                <th scope="col">Created Date</th>
                <th scope="col">Status</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php if ($shippingMethods->count() == 0) : ?>
            <tr>
                <td colspan="8" class="text-center">No Records Found.</td>
            </tr>
        <?php else : ?>
            <?php foreach ($shippingMethods as $shippingMethod) :
                $id = $shippingMethod->{$shippingMethod->getPrimaryKey()};
                [$status,$statusClass] = $statuses[$shippingMethod->status];
            ?>
            <tr>
                <td><?= $id ?></td>
                <td><?= $shippingMethod->name ?></td>
                <td><?= $shippingMethod->code ?></td>
                <td><?= $shippingMethod->amount ?></td>
                <td><?= $shippingMethod->description ?></td>
                <td><?= $shippingMethod->createdDate ?></td>
                <td><a class="btn <?= $statusClass ?>" href="javascript:void(0);" onclick="mage.setUrl('<?= UrlManager::getUrl('toggleStatus', null, [$shippingMethod->getPrimaryKey() => $id]) ?>').resetParams().load()"><?= $status ?></a></td>
                <td>
                    <a href="javascript:void(0);" onclick="mage.setUrl('<?= UrlManager::getUrl('edit', NULL, [$shippingMethod->getPrimaryKey() => $id]) ?>').resetParams().load()" class="btn btn-primary"><i class="fas fa-edit fa-fw"></i></a>
                    <a href="javascript:void(0);" onclick="mage.setUrl('<?= UrlManager::getUrl('delete', NULL, [$shippingMethod->getPrimaryKey() => $id]) ?>').resetParams().load()" class="btn btn-danger"><i class="fas fa-trash fa-fw"></i></a>
                </td>
            </tr>
            <?php endforeach ?>
        <?php endif ?>
        </tbody>
    </table>
</div>
