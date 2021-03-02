<?php
$statuses = [
    Model_Customer::STATUS_DISABLED => ['Disabled', 'btn-danger'],
    Model_Customer::STATUS_ENABLED  => ['Enabled', 'btn-success']
];
$customers = $this->customers;
?>

<div class="container-fluid">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <p class="h2 d-inline">Customers</p>
        <a href="<?= Model_Core_UrlManager::getUrl('add', null, null, true) ?>" class="btn btn-success">Add Customer</a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Group</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Email</th>
                <th scope="col">Zip Code</th>
                <th scope="col">Status</th>
                <th scope="col">Created Date</th>
                <th scope="col">Updated Date</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
<?php foreach ($customers as $customer) {
    $id = $customer->{$customer->getPrimaryKey()};
    [$status, $statusClass] = $statuses[$customer->status];
    $addressIds = explode(',', $customer->addressIds);
?>
            <tr>
                <td><?= $id ?></td>
                <td><?= $customer->groupName ?? '-' ?></td>
                <td><?= $customer->firstName ?></td>
                <td><?= $customer->lastName ?></td>
                <td><?= $customer->email ?></td>
                <td><?= $customer->zipcode ?></td>
                <td><a class="btn <?= $statusClass ?>" href="<?= Model_Core_UrlManager::getUrl('toggleStatus', NULL, ['id'=>$customer->id]) ?>"><?= $status ?></a></td>
                <td><?= $customer->createdDate ?></td>
                <td><?= $customer->updatedDate ?></td>
                <td>
                    <a href="<?= Model_Core_UrlManager::getUrl('edit', NULL, [$customer->getPrimaryKey() => $id, 'billingAddressId' => $addressIds[0] ?? '', 'shippingAddressId' => $addressIds[1] ?? '']) ?>" class="btn btn-primary"><i class="fas fa-edit fa-fw"></i></a>
                    <a href="<?= Model_Core_UrlManager::getUrl('delete', NULL, [$customer->getPrimaryKey() => $id, ]) ?>" class="btn btn-danger"><i class="fas fa-trash fa-fw"></i></a>
                </td>
            </tr>
<?php } ?>
        </tbody>
    </table>
</div>