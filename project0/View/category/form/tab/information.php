<?php
$category = $this->category;
$statusState = $this->statusState;
?>
<div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="category[name]" id="name" class="form-control" value="<?= $category->name ?>">
</div>
<div class="form-group">
    <label for="description">Description</label>
    <textarea name="category[description]" id="description" class="form-control"><?= $category->description ?></textarea>
</div>
<div class="form-group">
    <div class="form-check">
        <input type="checkbox" name="category[status]" id="status" class="form-check-input" <?= $statusState ?>>
        <label for="status">Enabled</label>
    </div>
</div>
<div class="from-group">
    <button type="submit" id="submit-btn" class="btn btn-primary small">Save</button>
    <a href="<?= Model_Core_UrlManager::getUrl('grid',null, null, true) ?>" class="btn btn-secondary ml-2">Cancel</a>
</div>
