<?php

abstract class Controller_Core_Base {
    protected $layout = null;
    protected $request = null;
    protected $messageService = null;

    function __construct() {
        $this->setRequest();
        $this->setLayout();
    }

    public function setMessageService($messageService = null) {
        if (!$messageService) {
            $messageService = new Model_Core_Message();
        }
        $this->messageService = $messageService;
        return $this;
    }

    public function getMessageService() {
        return $this->messageService;
    }

    public function setLayout(Block_Core_Layout $layout = null) {
        if (!$layout) {
            $layout  = new Block_Core_Layout();
        }
        $this->layout = $layout;
        return $this;
    }

    public function getLayout() {
        return $this->layout;
    }

    public function __set($key, $value)
    {
        $this->context[$key] = $value;
        return $this;
    }

    public function __get($key)
    {
        if (!array_key_exists($key, $this->context)) {
            return null;
        }
        return $this->context[$key];
    }

    public function getRequest() {
        if (!$this->request) {
            $this->setRequest();
        }
        return $this->request;
    }

    public function setRequest(Model_Core_Request $request = null) {
        if (!$request) {
            $request = new Model_Core_Request();            
        }
        $this->request = $request;
        return $this;
    }

}