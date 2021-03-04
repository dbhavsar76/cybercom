<?php
$formMode = $this->formMode;
$formAction = $this->formAction;
?>

<section>
<div class="container-fluid">
    <p class="h2 mt-3"><?= $formMode ?> Category</p>
    <hr class="hr-dark">
    <form id="editForm" action="<?= $formAction ?>" method="post">
        <?= $this->getChild('tab')->render() ?>
    </form>
</div>
</section>