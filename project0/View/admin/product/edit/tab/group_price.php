<?php
$gpPrimaryKey = (new \Model\Product\Group\Price)->getPrimaryKey();
$cgPrimaryKey = (new \Model\Customer\Group)->getPrimaryKey();
$groupPrices = $this->groupPrices;
$productPrice = $this->productPrice;
?>

<fieldset>
    <legend>Product Price</legend>
    <div class="form-group row mx-0">
        <label class="col-sm-3 col-form-label" for="product-price">Original Price</label>
        <div class="col-sm-9">
            <input type="text" id="product-price" class="form-control text-dark bg-light" value="<?= $productPrice ?>" disabled>
        </div>
    </div>
</fieldset>
<fieldset>
    <legend>Group Prices</legend>
    <?php foreach($groupPrices as $groupPrice): ?>
    <div class="form-group row mx-0">
        <label class="col-sm-3 col-form-label" for="<?= $groupPrice->$cgPrimaryKey ?>-price"><?= $groupPrice->name ?></label>
        <div class="col-sm-9">
            <input type="number" name="groupPrices[<?= $groupPrice->$gpPrimaryKey ? 'existing' : 'new' ?>][<?= $groupPrice->$gpPrimaryKey ?? $groupPrice->$cgPrimaryKey ?>]" id="<?= $groupPrice->$cgPrimaryKey ?>-price" value="<?= $groupPrice->price ?>" class="form-control" placeholder="Price for this group">
        </div>
    </div>
    <?php endforeach ?>
</fieldset>