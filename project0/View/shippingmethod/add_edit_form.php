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
    <?= $this->getChild('tab')->render() ?>
    </form>
</div>
</section>