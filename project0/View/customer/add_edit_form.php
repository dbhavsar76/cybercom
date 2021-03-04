<?php
$formMode = $this->formMode;
$formAction = $this->formAction;
?>

<div class="container-fluid">
    <p class="h2 mt-3"><?= $formMode ?> Customer</p>
    <hr class="hr-dark">
    <form id="editForm" action="<?= $formAction ?>" method="post">
        <div id="formTab">
        <?= $this->getChild('tab')->render(); ?>
        </div>
        <div class="from-group">
            <a href="#" onclick="mage.setForm('#editForm').load()" id="submit-btn" class="btn btn-primary">Save</a>
            <a href="#" onclick="mage.setUrl('<?= Model_Core_UrlManager::getUrl('grid', null, null, true) ?>').resetParams().load()" class="btn btn-secondary text-white ml-2">Cancel</a>
        </div>
    </form>
</div>
