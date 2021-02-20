<?php
$statuses = [
    Model_PaymentMethod::STATUS_DISABLED => ['Disabled', 'btn-danger'],
    Model_PaymentMethod::STATUS_ENABLED  => ['Enabled', 'btn-success']
];
$paymentMethods = $this->paymentMethods;
?>

<section class="my-3">
<div class="container-fluid">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <p class="h2 d-inline">Payment Methods</p>
        <a href="<?= $this->getUrl('add') ?>" class="btn btn-success">Create Payment Method</a>
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
                <td><a class="btn <?= $statusClass ?>" href="<?= $this->getUrl('toggleStatus', null, [$paymentMethod->getPrimaryKey() => $id]) ?>"><?= $status ?></a></td>
                <td><?= $paymentMethod->createdDate ?></td>
                <td>
                    <a href="<?= $this->getUrl('edit', NULL, [$paymentMethod->getPrimaryKey() => $id]) ?>" class="btn btn-primary"><i class="fas fa-edit fa-fw"></i></a>
                    <a href="<?= $this->getUrl('delete', NULL, [$paymentMethod->getPrimaryKey() => $id]) ?>" class="btn btn-danger"><i class="fas fa-trash fa-fw"></i></a>
                </td>
            </tr>
<?php } ?>
        </tbody>
    </table>
</div>
</section>