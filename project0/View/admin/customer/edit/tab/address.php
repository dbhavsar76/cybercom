<?php
$billingAddress = $this->billingAddress;
$shippingAddress = $this->shippingAddress;
?>
<div class="row">
    <fieldset id="billingAddress" class="col-md-6">
        <legend>Billing Address</legend>
        <div class="form-group">
            <label for="b-address">Address</label>
            <input class="form-control" type="text" name="billingAddress[address]" id="b-address" value="<?= $billingAddress->address ?>">
        </div>
        <div class="form-group">
            <label for="b-city">City</label>
            <input class="form-control" type="text" name="billingAddress[city]" id="b-city" value="<?= $billingAddress->city ?>">
        </div>
        <div class="form-group">
            <label for="b-zipcode">Zip Code</label>
            <input class="form-control" type="number" name="billingAddress[zipcode]" id="b-zipcode" value="<?= $billingAddress->zipcode ?>">
        </div>
        <div class="form-group">
            <label for="b-state">State</label>
            <input class="form-control" type="text" name="billingAddress[state]" id="b-state" value="<?= $billingAddress->state ?>">
        </div>
        <div class="form-group">
            <label for="b-country">Country</label>
            <input class="form-control" type="text" name="billingAddress[country]" id="b-country" value="<?= $billingAddress->country ?>">
        </div>
        <input type="hidden" name="billingAddress[type]" value="billing">
        <div class="form-group">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="copyAddress" id="copy-address">
                <label for="copy-address">Copy this address to Shipping Address</label>
            </div>
        </div>
    </fieldset>
    <fieldset id="shippingAddress" class="col-md-6">
        <legend>Shipping Address</legend>
        <div class="form-group">
            <label for="s-address">Address</label>
            <input class="form-control" type="text" name="shippingAddress[address]" id="s-address" value="<?= $shippingAddress->address ?>">
        </div>
        <div class="form-group">
            <label for="s-city">City</label>
            <input class="form-control" type="text" name="shippingAddress[city]" id="s-city" value="<?= $shippingAddress->city ?>">
        </div>
        <div class="form-group">
            <label for="s-zipcode">Zip Code</label>
            <input class="form-control" type="number" name="shippingAddress[zipcode]" id="s-zipcode" value="<?= $shippingAddress->zipcode ?>">
        </div>
        <div class="form-group">
            <label for="s-state">State</label>
            <input class="form-control" type="text" name="shippingAddress[state]" id="s-state" value="<?= $shippingAddress->state ?>">
        </div>
        <div class="form-group">
            <label for="s-country">Country</label>
            <input class="form-control" type="text" name="shippingAddress[country]" id="s-country" value="<?= $shippingAddress->country ?>">
        </div>
        <input type="hidden" name="shippingAddress[type]" value="shipping">
    </fieldset>
</div>
<script>
    $('#copy-address').change(function(e) {
        document.querySelector('#shippingAddress').disabled = this.checked;
    });
</script>
