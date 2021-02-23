<?php

abstract class Controller_Core_Base {
    protected $layout = null;
    private $request = null;
    private $context = [];

    function __construct() {
        $this->request = new Model_Core_Request();
        $this->setLayout();
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
        if (!array_key_exists($key, $this->context)) return null;
        return $this->context[$key];
    }

    public function getRequest() {
        if (!$this->request) $this->request = new Model_Core_Request();
        return $this->request;
    }
}