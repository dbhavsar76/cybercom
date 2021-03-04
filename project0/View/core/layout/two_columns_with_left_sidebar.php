<?php
include ROOT.'/View/core/start.php';

echo $this->getChild('header')->render();
?>
<div class="row mx-0">
    <section id="left" class="col-2">
        <?php echo $this->getChild('left')->render(); ?>
    </section>
    <section id="content" class="col-10">
        <section id="message">
            <?php
                $message = $this->getMessageService()->getMessage();
                if ($message) {
                    echo (new Block_Core_Message($message))->render();
                    $this->getMessageService()->clearMessage();
                }
            ?>
        </section>
        <?php echo $this->getChild('content')->render(); ?>
    </section>
</div>
<?php
echo $this->getChild('footer')->render();
include ROOT.'/View/core/end.php';
?>
