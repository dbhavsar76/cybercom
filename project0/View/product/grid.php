<?php
$statuses = [
    Model_Product::STATUS_DISABLED => ['Disabled', 'btn-danger'],
    Model_Product::STATUS_ENABLED  => ['Enabled', 'btn-success']
];
$products = $this->products;
?>

<div class="container-fluid">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <p class="h2 d-inline">Products</p>
        <a href="<?= Model_Core_UrlManager::getUrl('add') ?>" class="btn btn-success">Create Product</a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">SKU</th>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col">Discount</th>
                <th scope="col">Quantity</th>
                <th scope="col" style="width: 320px;">Description</th>
                <th scope="col">Status</th>
                <th scope="col">Created Date</th>
                <th scope="col">Updated Date</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
<?php foreach ($products as $product) {
    $id = $product->{$product->getPrimaryKey()};
    [$status,$statusClass] = $statuses[$product->status];
?>
            <tr>
                <td><?= $id ?></td>
                <td><?= $product->sku ?></td>
                <td><?= $product->name ?></td>
                <td><?= $product->price ?></td>
                <td><?= $product->discount ?></td>
                <td><?= $product->quantity ?></td>
                <td><?= $product->description ?></td>
                <td><a class="btn <?= $statusClass ?>" href="<?= Model_Core_UrlManager::getUrl('toggleStatus', null, [$product->getPrimaryKey() => $id]) ?>"><?= $status ?></a></td>
                <td><?= $product->createdDate ?></td>
                <td><?= $product->updatedDate ?></td>
                <td>
                    <a href="<?= Model_Core_UrlManager::getUrl('edit', NULL, [$product->getPrimaryKey() => $id]) ?>" class="btn btn-primary"><i class="fas fa-edit fa-fw"></i></a>
                    <a href="<?= Model_Core_UrlManager::getUrl('delete', NULL, [$product->getPrimaryKey() => $id]) ?>" class="btn btn-danger"><i class="fas fa-trash fa-fw"></i></a>
                </td>
            </tr>
<?php } ?>
        </tbody>
    </table>
</div>
