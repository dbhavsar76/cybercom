<?php

class Block_Core_Message extends Block_Core_Template {
    public const MESSAGE_SUCCESS = 'alert-success';
    public const MESSAGE_FAILURE = 'alert-danger';
    public const MESSAGE_NOTICE = 'alert-warning';

    public function __construct(array $message) {
        $this->setTemplate('/core/message.php');
        $this->alertClass = constant('self::'.$message['type']);
        $this->alertMessage = $message['message'];
    }
}