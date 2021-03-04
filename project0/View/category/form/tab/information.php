<?php
$category = $this->category;
$statusState = $this->statusState;
$categoryOptions = $this->categoryOptions;

function printCategoryOptions($categories, $current, $prefix = '') {
    $primaryKey = (new Model_Category)->getPrimaryKey();

    foreach($categories as $category) {
        $selected = $category->$primaryKey == $current->parentId ? 'selected' : '';
?>
    <option value="<?= $category->$primaryKey ?>" <?= $selected ?>><?= $prefix . $category->name ?></option>
<?php
    printCategoryOptions($category->getChildren(), $current, $prefix . "{$category->name} => ");
   }
}


?>
<div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="category[name]" id="name" class="form-control" value="<?= $category->name ?>">
</div>
<div class="form-group">
    <label for="parent-category">Parent Category</label>
    <select class="form-control" name="category[parentId]" id="parent-category">
    <option value="0">---</option>
    <?php printCategoryOptions($categoryOptions, $category); ?>
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
<div class="from-group">
    <a href="#" onclick="mage.setForm('#editForm').load()" id="submit-btn" class="btn btn-primary">Save</a>
    <a href="#" onclick="mage.setUrl('<?= Model_Core_UrlManager::getUrl('grid', null, null, true) ?>').resetParams().load()" class="btn btn-secondary text-white ml-2">Cancel</a>
</div>
