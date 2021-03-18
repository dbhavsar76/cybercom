<?php 

include ROOT.'/View/core/start.php';
echo $this->getChild('header')->render();
?>
<section id="content">
    <section id="message">
        <?php
        $message = $this->getMessageService()->getMessage();
        if ($message) {
            echo (new \Block\Core\Message($message))->render();
            $this->getMessageService()->clearMessage();
        }
        ?>
    </section>
    <?= $this->getChild('content')->render(); ?>
</section>
<?php
echo $this->getChild('footer')->render();

include ROOT.'/View/core/end.php';