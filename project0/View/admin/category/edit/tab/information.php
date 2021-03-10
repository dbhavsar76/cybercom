<?php
use \Model\Core\UrlManager;

$category = $this->category;
$statusState = $this->statusState;
$categoryOptions = $this->categoryOptions;
$primaryKey = $category->getPrimaryKey();
?>
<div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="category[name]" id="name" class="form-control" value="<?= $category->name ?>">
</div>
<div class="form-group">
    <label for="parent-category">Parent Category</label>
    <select class="form-control" name="category[parentId]" id="parent-category">
    <option value="0">---</option>
<?php foreach ($categoryOptions as $option) : ?>
    <?php if (!in_array($category->$primaryKey, explode(',', $option->path))) : ?>
    <option value="<?= $option->$primaryKey ?>" <?= $option->$primaryKey == $category->parentId ? 'selected' : '' ?>><?= $option->getFullName() ?></option>
    <?php endif ?>
<?php endforeach ?>
    </select>
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
