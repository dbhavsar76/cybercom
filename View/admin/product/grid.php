<?php
use Model\Core\UrlManager;

$statuses = [
    \Model\Product::STATUS_DISABLED => ['Disabled', 'btn-danger'],
    \Model\Product::STATUS_ENABLED  => ['Enabled', 'btn-success']
];
$products = $this->products;
?>

<div class="container-fluid">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <p class="h2 d-inline">Products</p>
        <a href="javascript:void(0);" onclick="mage.setUrl('<?= UrlManager::getUrl('add') ?>').resetParams().load()" class="btn btn-success">Create Product</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th class="align-top" scope="col">ID</th>
                <th class="align-top" scope="col">SKU</th>
                <th class="align-top" scope="col">Name</th>
                <th class="align-top" scope="col">Price</th>
                <th class="align-top" scope="col">Discount</th>
                <th class="align-top" scope="col">Quantity</th>
                <th class="align-top" scope="col" style="width: 320px;">Description</th>
                <th class="align-top" scope="col">Status</th>
                <th class="align-top" scope="col">Created Date</th>
                <th class="align-top" scope="col">Updated Date</th>
                <th class="align-top" scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php if ($products->count() == 0) : ?>
            <tr>
                <td colspan="11" class="text-center">No Records Found.</td>
            </tr>
        <?php else : ?>
            <?php foreach ($products as $product) :
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
                <td><a class="btn <?= $statusClass ?>" href="javascript:void(0);" onclick="mage.setUrl('<?= UrlManager::getUrl('toggleStatus', null, [$product->getPrimaryKey() => $id]) ?>').resetParams().load()"><?= $status ?></a></td>
                <td><?= $product->createdDate ?></td>
                <td><?= $product->updatedDate ?></td>
                <td>
                    <a href="javascript:void(0);" onclick="mage.setUrl('<?= UrlManager::getUrl('edit', NULL, [$product->getPrimaryKey() => $id]) ?>').resetParams().load()" class="btn btn-primary"><i class="fas fa-edit fa-fw"></i></a>
                    <a href="javascript:void(0);" onclick="mage.setUrl('<?= UrlManager::getUrl('delete', NULL, [$product->getPrimaryKey() => $id]) ?>').resetParams().load()" class="btn btn-danger"><i class="fas fa-trash fa-fw"></i></a>
                </td>
            </tr>
            <?php endforeach ?>
        <?php endif ?>
        </tbody>
    </table>
</div>
