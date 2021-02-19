<?php

abstract class Block_Core_Base {
    protected $template = null;
    protected $context = [];

    function __construct() {}

    public function render() {
        include $template;
    }

    public function setTemplate($template) {
        $this->template = $template;
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
}