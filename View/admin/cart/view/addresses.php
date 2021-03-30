<?php
$cart = Mage::getRegistry('current_cart');
$billingAddress = $this->billingAddress;
$shippingAddress = $this->shippingAddress;
$paymentMethods = $this->paymentMethods;
$shippingMethods = $this->shippingMethods;
?>

<div class="container-fluid">
    <div class="row mx-0">
    <fieldset id="billingAddress" class="col-md-6">
        <legend>Billing Address</legend>
        <div class="form-group">
            <label for="b-address">Address</label>
            <input class="form-control" type="text" name="cartAddress[billing][address]" id="b-address" value="<?= $billingAddress->address ?>">
        </div>
        <div class="form-group">
            <label for="b-city">City</label>
            <input class="form-control" type="text" name="cartAddress[billing][city]" id="b-city" value="<?= $billingAddress->city ?>">
        </div>
        <div class="form-group">
            <label for="b-zipcode">Zip Code</label>
            <input class="form-control" type="number" name="cartAddress[billing][zipcode]" id="b-zipcode" value="<?= $billingAddress->zipcode ?>">
        </div>
        <div class="form-group">
            <label for="b-state">State</label>
            <input class="form-control" type="text" name="cartAddress[billing][state]" id="b-state" value="<?= $billingAddress->state ?>">
        </div>
        <div class="form-group">
            <label for="b-country">Country</label>
            <input class="form-control" type="text" name="cartAddress[billing][country]" id="b-country" value="<?= $billingAddress->country ?>">
        </div>
        <input type="hidden" name="cartAddress[billing][type]" value="billing">
        <?php if ($billingAddress->getId()) : ?>
        <input type="hidden" name="cartAddress[billing][<?= $billingAddress->getPrimaryKey() ?>]" value="<?= $billingAddress->getId() ?>">
        <?php endif ?>
        <div class="form-group">
            <div class="form-check d-inline">
                <input class="form-check-input" type="checkbox" name="cartAddress[copyToShipping]" id="copy-address">
                <label for="copy-address">Copy this address to Shipping Address</label>
            </div>
            <a href="javascript:void(0);" onclick="mage.resetParams().setForm('#cartForm').load()" class="btn btn-success float-right">Save</a>
        </div>
    </fieldset>
    <fieldset id="shippingAddress" class="col-md-6">
        <legend>Shipping Address</legend>
        <div class="form-group">
            <label for="s-address">Address</label>
            <input class="form-control" type="text" name="cartAddress[shipping][address]" id="s-address" value="<?= $shippingAddress->address ?>">
        </div>
        <div class="form-group">
            <label for="s-city">City</label>
            <input class="form-control" type="text" name="cartAddress[shipping][city]" id="s-city" value="<?= $shippingAddress->city ?>">
        </div>
        <div class="form-group">
            <label for="s-zipcode">Zip Code</label>
            <input class="form-control" type="number" name="cartAddress[shipping][zipcode]" id="s-zipcode" value="<?= $shippingAddress->zipcode ?>">
        </div>
        <div class="form-group">
            <label for="s-state">State</label>
            <input class="form-control" type="text" name="cartAddress[shipping][state]" id="s-state" value="<?= $shippingAddress->state ?>">
        </div>
        <div class="form-group">
            <label for="s-country">Country</label>
            <input class="form-control" type="text" name="cartAddress[shipping][country]" id="s-country" value="<?= $shippingAddress->country ?>">
        </div>
        <input type="hidden" name="cartAddress[shipping][type]" value="shipping">
        <div class="text-right">
            <a href="javascript:void(0);" onclick="mage.resetParams().setForm('#cartForm').load()" class="btn btn-success">Save</a>
        </div>
    </fieldset>
        <?php if ($shippingAddress->getId()) : ?>
        <input type="hidden" name="cartAddress[shipping][<?= $shippingAddress->getPrimaryKey() ?>]" value="<?= $shippingAddress->getId() ?>">
        <?php endif ?>
    </div>
    <div class="row mx-0">
        <fieldset class="col-md-6">
            <legend><label for="payment-method">Payment Method</label></legend>
            <select name="cart[paymentMethodId]" id="payment-method" class="custom-select mb-2">
                <option value="">Select Payment Method</option>
                <?php foreach ($paymentMethods as $paymentMethod) : ?>
                <option value="<?= $paymentMethod->getId() ?>" <?= $cart->paymentMethodId == $paymentMethod->getId() ? 'selected' : '' ?>><?= $paymentMethod->name ?></option>
                <?php endforeach ?>
            </select>
            <div class="text-right">
                <a href="javascript:void(0);" onclick="mage.resetParams().setForm('#cartForm').load()" class="btn btn-success">Save</a>
            </div>
        </fieldset>
        <fieldset class="col-md-6">
            <legend><label for="shipping-method">Shipping Method</label></legend>
            <select name="cart[shippingMethodId]" id="shipping-method" class="custom-select mb-2">
                <option value="">Select Shipping Method</option>
                <?php $shippingAmount = '' ?>
                <?php foreach ($shippingMethods as $shippingMethod) : ?>
                <?php if ($cart->shippingMethodId == $shippingMethod->getId()) { $shippingAmount = $shippingMethod->amount; } ?>
                <option data-amount="<?= $shippingMethod->amount ?>" value="<?= $shippingMethod->getId() ?>" <?= $cart->shippingMethodId == $shippingMethod->getId() ? 'selected' : '' ?>><?= $shippingMethod->name ?> ($<?= $shippingMethod->amount ?>)</option>
                <?php endforeach ?>
            </select>
            <input id="shipping-amount" type="hidden" name="cart[shippingAmount]" value="<?= $shippingAmount ?>">
            <div class="text-right">
                <a href="javascript:void(0);" onclick="mage.resetParams().setForm('#cartForm').load()" class="btn btn-success">Save</a>
            </div>
        </fieldset>
    </div>
</div>
<script>
    $('#copy-address').change(function(e) {
        document.querySelector('#shippingAddress').disabled = this.checked;
    });

    $('#shipping-method').change(function(e) {
        let optionSelected = $("option:selected", this);
        $('#shipping-amount').val(optionSelected.data('amount'));
    });
</script>
