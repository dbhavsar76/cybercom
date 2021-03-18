<?php
$paymentMethod = $this->paymentMethod;
$statusState = $this->statusState;
?>
<fieldset>
    <legend>Information</legend>
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="paymentMethod[name]" id="name" class="form-control" value="<?= $paymentMethod->name ?>">
    </div>
    <div class="form-group">
        <label for="code">Code</label>
        <input type="text" name="paymentMethod[code]" id="code" class="form-control" value="<?= $paymentMethod->code ?>">
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="paymentMethod[description]" id="description" class="form-control"><?= $paymentMethod->description ?></textarea>
    </div>
    <div class="form-group">
        <div class="form-check">
            <input type="checkbox" name="paymentMethod[status]" id="status" class="form-check-input" <?= $statusState ?>>
            <label for="status">Enabled</label>
        </div>
    </div>
</fieldset>
