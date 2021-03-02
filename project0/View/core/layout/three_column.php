<?php
include ROOT.'/View/core/start.php';
echo $this->getChild('header')->render();
?>
<div class="row mx-0">
    <div class="col-2">
        <?= $this->getChild('left')->render() ?>
    </div>
    <div class="col-8">
        <?php
            $message = $this->getMessageService()->getMessage();
            if ($message) {
                echo (new Block_Core_Message($message))->render();
                $this->getMessageService()->clearMessage();
            }
        ?>
        <?= $this->getChild('content')->render() ?>
    </div>
    <div class="col-2">
        <?= $this->getChild('right')->render() ?>
    </div>
</div>
<?php
echo $this->getChild('footer')->render();
include ROOT.'/View/core/end.php';
?>
