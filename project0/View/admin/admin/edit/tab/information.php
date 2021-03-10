<?php

$admin = $this->admin; 
$statusState = $this->statusState;
?>
<div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="admin[name]" id="name" class="form-control" value="<?= $admin->name ?>">
</div>
<div class="form-group">
    <label for="email">Email</label>
    <input type="email" name="admin[email]" id="email" class="form-control" value="<?= $admin->email ?>">
</div>
<div class="form-group">
    <label for="password">Password</label>
    <input type="password" name="admin[password]" id="password" class="form-control">
</div>
<div class="form-group">
    <label for="password2">Confirm Password</label>
    <input type="password" name="admin[password2]" id="password2" class="form-control">
</div>
<div class="form-group">
    <div class="form-check">
        <input type="checkbox" name="admin[status]" id="status" class="form-check-input" <?= $statusState ?>>
        <label for="status">Enabled</label>
    </div>
</div>
