<?php
$gpPrimaryKey = (new \Model\Product\Group\Price)->getPrimaryKey();
$cgPrimaryKey = (new \Model\Customer\Group)->getPrimaryKey();
$groupPrices = $this->groupPrices;
$productPrice = $this->productPrice;
?>

<fieldset>
    <legend>Group Prices</legend>
    <table class="table table-borderless">
        <thead>
            <tr>
                <th scope="col">Group</th>
                <th scope="col">Product Price</th>
                <th scope="col">Group Price</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($groupPrices as $groupPrice): ?>
            <tr>
                <td><label for="<?= $groupPrice->$cgPrimaryKey ?>-price"><?= $groupPrice->name ?></label></td>
                <td><?= $productPrice ?></td>
                <td><input type="number" name="groupPrices[<?= $groupPrice->$gpPrimaryKey ? 'existing' : 'new' ?>][<?= $groupPrice->$gpPrimaryKey ?? $groupPrice->$cgPrimaryKey ?>]" id="<?= $groupPrice->$cgPrimaryKey ?>-price" value="<?= $groupPrice->price ?>" class="form-control" placeholder="Price for this group"></td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
</fieldset>