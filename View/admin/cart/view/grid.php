<?php
use \Model\Core\UrlManager;

$cartItems = $this->cartItems;
?>

<div class="container-fluid">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <p class="h4 d-inline">Cart Items</p>
        <a href="javascript:void(0);" onclick="mage.resetParams().setForm('#cartForm').load()" class="btn btn-success">Update Cart</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">&nbsp;</th>
                <th scope="col">Product</th>
                <th scope="col">Base Price</th>
                <th scope="col">Discount (%)</th>
                <th scope="col">Quantity</th>
                <th scope="col">Price</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php if (!$cartItems || $cartItems->count() == 0) : ?>
            <tr>
                <td class="text-center" colspan="7">No Records Found.</td>
            </tr>
        <?php else : ?>
            <?php foreach ($cartItems as $item) : ?>
            <tr>
                <td><?= $item->getThumb() ?></td>
                <td><?= $item->getName() ?></td>
                <td>$<?= $item->basePrice ?></td>
                <td><?= $item->discount ?></td>
                <td><input type="number" name="cartItem[<?= $item->getId() ?>][quantity]" value="<?= $item->quantity ?>"></td>
                <td>$<?= $item->price ?></td>
                <td>
                    <a href="javascript:void(0);" onclick="mage.setUrl('<?= UrlManager::getUrl('delete', null, [$item->getPrimaryKey() => $item->getId()]) ?>').resetParams().load()" class="btn btn-danger"><i class="fas fa-trash fa-fw"></i></a>
                </td>
            </tr>
            <?php endforeach ?>
        <?php endif ?>
        </tbody>
    </table>
</div>