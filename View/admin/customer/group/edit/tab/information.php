<?php
$customerGroup = $this->customerGroup;
$isDefault = $customerGroup->default == \Model\Customer\Group::DEFAULT ? 'checked disabled' : '';
?>
<fieldset>
    <legend>Information</legend>
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
</fieldset>
