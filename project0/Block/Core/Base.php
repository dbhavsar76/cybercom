<?php

abstract class Block_Core_Base {
    protected $template = null;
    protected $controller = null;
    protected $context = [];

    function __construct() {}

    public function render() {
        include $this->template;
    }

    public function getUrl($actionName = null, $controllerName = null, array $additionalParams = null, $reset = false) {
        return $this->controller->getUrl($actionName, $controllerName, $additionalParams, $reset);
    }

    public function setTemplate($template) {
        $this->template = $template;
    }

    public function getTemplate() {
        return $this->template;
    }

    public function setController($controller) {
        $this->controller = $controller;
    }

    public function getController() {
        return $this->controller;
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