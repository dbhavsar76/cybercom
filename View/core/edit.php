<?php
use \Model\Core\UrlManager;

$formMode = $this->formMode;
$formAction = $this->formAction;
$title = $this->title;
?>

<div class="container-fluid">
    <p class="h2 mt-3"><?= $formMode ?> <?= $title ?></p>
    <hr class="hr-dark">
    <form id="editForm" action="<?= $formAction ?>" method="post">
        <div id="tab" class="px-2">
            <?= $this->getChild('tab')->render() ?>
        </div>
        <div class="from-group">
            <a href="javascript:void(0);" onclick="mage.setForm('#editForm').load()" id="submit-btn" class="btn btn-primary">Save</a>
            <a href="javascript:void(0);" onclick="mage.setUrl('<?= UrlManager::getUrl('grid', null, null, true) ?>').resetParams().load()" class="btn btn-secondary text-white ml-2">Cancel</a>
        </div>
    </form>
</div>
