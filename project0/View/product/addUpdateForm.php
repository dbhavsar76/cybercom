
<section>
<div class="container-fluid">
    <p class="h2 mt-3"><?= $formMode ?> Product</p>
    <hr class="hr-dark">
    <form action="<?= $formAction ?>" method="post">
    <div class="row">
    <div class="col-5">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="product[name]" id="name" class="form-control" value="<?= $product->name ?>">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="product[description]" id="description" class="form-control"><?= $product->description ?></textarea>
        </div>
        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" name="product[quantity]" id="quantity" class="form-control" value="<?= $product->quantity ?>">
        </div>
        <div class="form-group">
            <div class="form-check">
                <input type="checkbox" name="product[status]" id="status" class="form-check-input" <?= $status ?>>
                <label for="status">Enabled</label>
            </div>
        </div>
        <div class="from-group">
            <button type="submit" id="submit-btn" class="btn btn-primary"><?= $formMode ?> Product</button>
            <a href="<?= $this->getUrl('list', null, null, true) ?>" class="btn btn-secondary ml-2">Cancel</a>
        </div>
    </div>
    <div class="col-5">
        <div class="form-group">
            <label for="sku">SKU</label>
            <input type="text" name="product[sku]" id="sku" class="form-control" value="<?= $product->sku ?>">
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" name="product[price]" id="price" class="form-control" value="<?= $product->price ?>">
        </div>
        <div class="form-group">
            <label for="discount">Discount</label>
            <input type="number" name="product[discount]" id="discount" class="form-control" value="<?= $product->discount ?>">
        </div>
    </div>
    </div>
    </form>
</div>
</section>