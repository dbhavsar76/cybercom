<?php use Model\Core\UrlManager; 
$cart = \Mage::getRegistry('current_cart');
?>

<div class="container-fluid">
    <div id="customer-selector">
        <?= $this->getChild('customerSelector')->render() ?>
    </div>
    <hr class="hr-dark">
    <?php if (\Mage::getRegistry('current_customer')) : ?>
        <form action="<?= UrlManager::getUrl('updateCart', null, null, true) ?>" id="cartForm">
            <div id="cart-grid">
                <?= $this->getChild('cartGrid')->render() ?>
            </div>
            <div id="cart-addresses">
                <?= $this->getChild('cartAddresses')->render() ?>
            </div>
        </form>
        <hr class="hr-dark">
        <div class="container d-flex flex-column align-items-center">
            <p class="h4 d-inline">Cart Totals</p>
            <table class="table table-striped table-borderless">
                <tr>
                    <td>Base Total :</td>
                    <td class="text-right">$<?= $this->baseTotal ?></td>
                </tr>
                <tr>
                    <td>Discount :</td>
                    <td class="text-right text-danger">- $<?= $this->discountTotal ?></td>
                </tr>
                <tr>
                    <td>Cart Discount :</td>
                    <td class="text-right">- $<?= $cart->discount ?></td>
                </tr>
                <tr>
                    <td>Shipping Amount :</td>
                    <td class="text-right">+ $<?= $cart->shippingAmount ?></td>
                </tr>
                <tr>
                    <td>Cart Total :</td>
                    <td class="text-right">$<?= $cart->total + $cart->shippingAmount ?></td>
                </tr>
            </table>
        </div>
        <hr class="hr-dark">
        <div class="text-center">
            <a href="javascript: void(0);" class="btn btn-primary">Place Order</a>
        </div>
    <?php endif ?>
</div>