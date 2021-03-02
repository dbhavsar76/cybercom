<?php
$customer = $this->customer;
$statusState = $this->statusState;
$customerGroups = (new Model_CustomerGroup)->loadAll();
?>
<div class="form-group">
    <label for="group">Group</label>
    <select name="customer[groupId]" id="group" class="form-control">
        <option value="null">No Group</option>
    <?php 
        foreach ($customerGroups as $customerGroup) {
            if ($customer->groupId && $customer->groupId == $customerGroup->{$customerGroup->getPrimaryKey()}) {
                $selected = 'selected';
            } else if ($customerGroup->default == Model_CustomerGroup::DEFAULT) {
                $selected = 'selected';
            } else {
                $selected = '';
            }
    ?>
        <option value="<?= $customerGroup->{$customerGroup->getPrimaryKey()} ?>" <?= $selected ?>><?= $customerGroup->name ?></option>
    <?php } ?>
    </select>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="firstName">First Name</label>
            <input type="text" name="customer[firstName]" id="firstName" class="form-control" value="<?= $customer->firstName ?>">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="lastName">Last Name</label>
            <input type="text" name="customer[lastName]" id="lastName" class="form-control" value="<?= $customer->lastName ?>">
        </div>
    </div>
</div>
<div class="form-group">
    <label for="email">Email</label>
    <input type="email" name="customer[email]" id="email" class="form-control" value="<?= $customer->email ?>">
</div>
<div class="form-group">
    <label for="password">Password</label>
    <input type="password" name="customer[password]" id="password" class="form-control">
</div>
<div class="form-group">
    <label for="password2">Confirm Password</label>
    <input type="password" name="customer[password2]" id="password2" class="form-control">
</div>
<div class="form-group">
    <div class="form-check">
        <input type="checkbox" name="customer[status]" id="status" class="form-check-input" <?= $statusState ?>>
        <label for="status">Enabled</label>
    </div>
</div>
<div class="from-group">
    <button type="submit" id="submit-btn" class="btn btn-primary">Save</button>
    <a href="<?= Model_Core_UrlManager::getUrl('grid', null, null, true) ?>" class="btn btn-secondary text-white ml-2">Cancel</a>
</div>
