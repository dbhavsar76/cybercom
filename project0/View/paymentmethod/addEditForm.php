<?php
$formMode = $this->formMode;
$formAction = $this->formAction;
$paymentMethod = $this->paymentMethod;
$statusState = $this->statusState;
?>

<section>
<div class="container-fluid">
    <p class="h2 mt-3"><?= $formMode ?> Payment Method</p>
    <hr class="hr-dark">
    <form action="<?= $formAction ?>" method="post">
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
        <div class="from-group">
            <button type="submit" id="submit-btn" class="btn btn-primary small">Save</button>
            <a href="<?= Model_Core_UrlManager::getUrl('grid',null, null, true) ?>" class="btn btn-secondary ml-2">Cancel</a>
        </div>
    </form>
</div>
</section>