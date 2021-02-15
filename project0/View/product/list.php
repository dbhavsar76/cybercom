<section class="my-3">
<div class="container-fluid">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <p class="h2 d-inline">Products</p>
        <a href="<?= $this->getUrl('add') ?>" class="btn btn-success">Create Product</a>
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
    $status = $product['status'] ? 'Enabled' : 'Disabled';
    $statusClass = $product['status'] ? 'text-success' : 'text-danger';
?>
            <tr>
                <td><?= $product['id'] ?></td>
                <td><?= $product['sku'] ?></td>
                <td><?= $product['name'] ?></td>
                <td><?= $product['price'] ?></td>
                <td><?= $product['discount'] ?></td>
                <td><?= $product['quantity'] ?></td>
                <td><?= $product['description'] ?></td>
                <td class="<?= $statusClass ?>"><?= $status ?></td>
                <td><?= $product['createdDate'] ?></td>
                <td><?= $product['updatedDate'] ?></td>
                <td>
                    <a href="<?= $this->getUrl('update', NULL, ['id'=> $product['id']]) ?>" class="btn btn-primary"><i class="fas fa-edit fa-fw"></i></a>
                    <a href="<?= $this->getUrl('delete', NULL, ['id'=> $product['id']]) ?>" class="btn btn-danger"><i class="fas fa-trash fa-fw"></i></a>
                </td>
            </tr>
<?php } ?>
        </tbody>
    </table>
</div>
</section>