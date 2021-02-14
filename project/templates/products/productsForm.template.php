<section>
<div class="container-fluid">
    <p class="h2 mt-3">Add Product</p>
    <hr class="hr-dark">
    <form action="" method="post">
    <div class="row">
    <div class="col-5">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" name="quantity" id="quantity" class="form-control">
        </div>
        <div class="form-group">
            <div class="form-check">
                <input type="checkbox" name="status" id="status" class="form-check-input" checked>
                <label for="status">Enabled</label>
            </div>
        </div>
        <div class="from-group">
            <button type="submit" id="submit-btn" class="btn btn-primary">Add Product</button>
            <button type="button" id="cancel-btn" class="btn btn-secondary ml-2">Cancel</button>
        </div>
    </div>
    <div class="col-5">
        <div class="form-group">
            <label for="sku">SKU</label>
            <input type="text" name="sku" id="sku" class="form-control">
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" name="price" id="price" class="form-control">
        </div>
        <div class="form-group">
            <label for="discount">Discount</label>
            <input type="number" name="discount" id="discount" class="form-control">
        </div>
    </div>
    </div>
    </form>
</div>
</section>