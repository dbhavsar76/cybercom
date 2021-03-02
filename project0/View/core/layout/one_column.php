<?php 
include ROOT.'/View/core/start.php';

echo $this->getChild('header')->render();

$message = $this->getMessageService()->getMessage();
if ($message) {
    echo (new Block_Core_Message($message))->render();
    $this->getMessageService()->clearMessage();
}

echo $this->getChild('content')->render();
echo $this->getChild('footer')->render();

include ROOT.'/View/core/end.php';