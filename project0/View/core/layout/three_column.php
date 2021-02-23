<?php
include ROOT.'/View/core/start.php';
$this->getChild('header')->render();
?>
<div class="row mx-0">
    <div class="col-2">
        <?php $this->getChild('left')->render(); ?>
    </div>
    <div class="col-8">
        <?php $this->getChild('content')->render(); ?>
    </div>
    <div class="col-2">
        <?php $this->getChild('right')->render(); ?>
    </div>
</div>
<?php
$this->getChild('footer')->render();
include ROOT.'/View/core/end.php';
?>
