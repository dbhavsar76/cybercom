<?php include ROOT.'/View/core/start.php'; ?>
<?php
    $message = $this->getMessageService()->getMessage();
    if ($message) {
        echo (new Block_Core_Message($message))->render();
        $this->getMessageService()->clearMessage();
    }
?>
<?php foreach ($this->getChildren() as $child) {
    echo $child->render();
} ?>
<?php include ROOT.'/View/core/end.php'; ?>