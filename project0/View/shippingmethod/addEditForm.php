<?php
$formMode = $this->formMode;
$formAction = $this->formAction;
$shippingMethod = $this->shippingMethod;
$statusState = $this->statusState;
?>

<section>
<div class="container-fluid">
    <p class="h2 mt-3"><?= $formMode ?> Shipping Method</p>
    <hr class="hr-dark">
    <form action="<?= $formAction ?>" method="post">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="shippingMethod[name]" id="name" class="form-control" value="<?= $shippingMethod->name ?>">
        </div>
        <div class="form-group">
            <label for="code">Code</label>
            <input type="text" name="shippingMethod[code]" id="code" class="form-control" value="<?= $shippingMethod->code ?>">
        </div>
        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="number" name="shippingMethod[amount]" id="amount" class="form-control" value="<?= $shippingMethod->amount ?>">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="shippingMethod[description]" id="description" class="form-control"><?= $shippingMethod->description ?></textarea>
        </div>
        <div class="form-group">
            <div class="form-check">
                <input type="checkbox" name="shippingMethod[status]" id="status" class="form-check-input" <?= $statusState ?>>
                <label for="status">Enabled</label>
            </div>
        </div>
        <div class="from-group">
            <button type="submit" id="submit-btn" class="btn btn-primary small"><?= $formMode ?> Shipping Method</button>
            <a href="<?= $this->getUrl('grid',null, null, true) ?>" class="btn btn-secondary ml-2">Cancel</a>
        </div>
    </form>
</div>
</section>