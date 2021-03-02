<?php

class Block_Core_Template {
    protected $template = null;
    protected $context = [];
    protected $children = [];
    protected $messageService = null;

    function __construct() {
        #empty
    }

    public function render() {
        ob_start();
        include $this->template;
        return ob_get_clean();
    }

    public function setTemplate($template) {
        $this->template = ROOT.'/View'.$template;
    }

    public function getTemplate() {
        return $this->template;
    }

    public function __set($key, $value) {
        $this->context[$key] = $value;
        return $this;
    }

    public function __get($key) {
        if (!array_key_exists($key, $this->context)) {
            return null;
        }
        return $this->context[$key];
    }

    public function setChildren(array $children = []) {
        $this->children = $children;
        return $this;
    }

    public function getChildren() {
        return $this->children;
    }

    public function addChild(Block_Core_Template $child, $key = null) {
        if (!$key) {
            $key = get_class($child);
        }
        $this->children[$key] = $child;
        return $this;
    }

    public function getChild($key) {
        if (!array_key_exists($key, $this->children)) {
            return null;
        } 
        return $this->children[$key];
    }

    public function removeChild($key) {
        if (array_key_exists($key, $this->children)) {
            unset($this->children[$key]);
        }
        return $this;
    }

    public function createBlock($className) {
        return new $className();
    }

    public function setMessageService($messageService = null) {
        if (!$messageService) {
            $messageService = new Model_Admin_Message();
        }
        $this->messageService = $messageService;
    }

    public function getMessageService() {
        if (!$this->messageService) {
            $this->setMessageService();
        }
        return $this->messageService;
    }

}