<?php
namespace Model\Admin;

class Message extends Session {
    public const SUCCESS = 'MESSAGE_SUCCESS';
    public const FAILURE = 'MESSAGE_FAILURE';
    public const NOTICE = 'MESSAGE_NOTICE';

    public function setMessage(string $message, $messageType) {
        $this->message = ['message' => $message, 'type' => $messageType];
        return $this;
    }

    public function setSuccess(string $message) {
        return $this->setMessage($message, self::SUCCESS);
    }

    public function setFailure(string $message) {
        return $this->setMessage($message, self::FAILURE);
    }

    public function setNotice(string $message) {
        return $this->setMessage($message, self::NOTICE);
    }

    public function getMessage() {
        return $this->message;
    }

    public function clearMessage() {
        unset($this->message);
    }
}