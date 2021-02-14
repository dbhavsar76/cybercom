<section>
<div class="container-fluid">
    <p class="h2 mt-3">Add Category</p>
    <hr class="hr-dark">
    <form action="" method="post">
        <input type="hidden" name="id" value="1">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <div class="form-check">
                <input type="checkbox" name="status" id="status" class="form-check-input" checked>
                <label for="status">Enabled</label>
            </div>
        </div>
        <div class="from-group">
            <button type="submit" id="submit-btn" class="btn btn-primary">Add Category</button>
            <button type="button" id="cancel-btn" class="btn btn-secondary ml-2">Cancel</button>
        </div>
    </form>
</div>
</section>