<?php
$customerGroup = $this->customerGroup;
$isDefault = $customerGroup->default == Model_CustomerGroup::DEFAULT ? 'checked disabled' : '';
?>
<div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="customerGroup[name]" id="name" class="form-control" value="<?= $customerGroup->name ?>">
</div>
<div class="form-group">
    <div class="form-check">
        <input type="checkbox" name="customerGroup[default]" id="default" class="form-check-input" <?= $isDefault ?>>
        <label for="default">Make This Default</label>
    </div>
</div>
<div class="from-group">
    <a href="#" onclick="mage.setForm('#editForm').load()" id="submit-btn" class="btn btn-primary">Save</a>
    <a href="#" onclick="mage.setUrl('<?= Model_Core_UrlManager::getUrl('grid', null, null, true) ?>').resetParams().load()" class="btn btn-secondary text-white ml-2">Cancel</a>
</div>
