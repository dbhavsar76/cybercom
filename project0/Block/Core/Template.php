<?php

class Block_Core_Template {
    protected $template = null;
    protected $context = [];
    protected $children = [];

    function __construct() {}

    public function render() {
        include $this->template;
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
        if (!array_key_exists($key, $this->context)) return null;
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

}