<?php
$formMode = $this->formMode;
$formAction = $this->formAction;
?>

<section>
<div class="container-fluid">
    <p class="h2 mt-3"><?= $formMode ?> Admin</p>
    <hr class="hr-dark">
    <form id="editForm" action="<?= $formAction ?>" method="post" class="col-lg-6">
        <?= $this->getChild('tab')->render() ?>
    </form>
</div>
</section>