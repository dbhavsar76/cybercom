<?php
$statuses = [
    Model_ShippingMethod::STATUS_DISABLED => ['Disabled', 'btn-danger'],
    Model_ShippingMethod::STATUS_ENABLED  => ['Enabled', 'btn-success']
];
$shippingMethods = $this->shippingMethods;
?>

<section class="my-3">
<div class="container-fluid">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <p class="h2 d-inline">Shipping Methods</p>
        <a href="<?= Model_Core_UrlManager::getUrl('add', null, null, true) ?>" class="btn btn-success">Create Shipping Method</a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Code</th>
                <th scope="col">Amount</th>
                <th scope="col">Description</th>
                <th scope="col">Status</th>
                <th scope="col">Created Date</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
<?php foreach ($shippingMethods as $shippingMethod) { 
        $id = $shippingMethod->{$shippingMethod->getPrimaryKey()};
        [$status,$statusClass] = $statuses[$shippingMethod->status];
?>
            <tr>
                <td><?= $id ?></td>
                <td><?= $shippingMethod->name ?></td>
                <td><?= $shippingMethod->code ?></td>
                <td><?= $shippingMethod->amount ?></td>
                <td><?= $shippingMethod->description ?></td>
                <td><a class="btn <?= $statusClass ?>" href="<?= Model_Core_UrlManager::getUrl('toggleStatus', null, [$shippingMethod->getPrimaryKey() => $id]) ?>"><?= $status ?></a></td>
                <td><?= $shippingMethod->createdDate ?></td>
                <td>
                    <a href="<?= Model_Core_UrlManager::getUrl('edit', NULL, [$shippingMethod->getPrimaryKey() => $id]) ?>" class="btn btn-primary"><i class="fas fa-edit fa-fw"></i></a>
                    <a href="<?= Model_Core_UrlManager::getUrl('delete', NULL, [$shippingMethod->getPrimaryKey() => $id]) ?>" class="btn btn-danger"><i class="fas fa-trash fa-fw"></i></a>
                </td>
            </tr>
<?php } ?>
        </tbody>
    </table>
</div>
</section>