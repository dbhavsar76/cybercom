<?php
$product = $this->product;
$categories = $this->categories;
?>

<fieldset>
    <legend>Categories</legend>
    <div class="form-group">

        <?php foreach ($categories as $category) : ?>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="productCategories[]" id="cat-<?= $category->id ?>" value="<?= $category->id ?>" <?= $category->productId ? 'checked' : '' ?>>
            <label class="form-check-label" for="cat-<?= $category->id ?>"><?= $category->getFullName() ?></label>
        </div>
        <?php endforeach ?>
        </select>
    </div>
</fieldset>