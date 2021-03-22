<?php

namespace Controller\Core;

abstract class Base {
    protected $layout = null;
    protected $request = null;
    protected $response = null;
    protected $session = null;
    protected $messageService = null;
    protected $filterService = null;

    function __construct() {
        $this->setRequest();
        $this->setResponse();
    }

    public function setSession($session = null) {
        if (!$session) {
            $session = new \Model\Core\Session;
        }
        $this->session = $session;
        return $this;
    }

    public function getSession() {
        return $this->session;
    }

    public function setMessageService($messageService = null) {
        if (!$messageService) {
            $messageService = new \Model\Core\Message();
        }
        $this->messageService = $messageService;
        return $this;
    }

    public function getMessageService() {
        return $this->messageService;
    }

    public function setFilterService($filterService = null) {
        if (!$filterService) {
            $filterService = new \Model\Core\Filter;
        }
        $this->filterService = $filterService;
        return $this;
    } 

    public function getFilterService() {
        return $this->filterService;
    }

    public function setLayout(\Block\Core\Layout $layout = null) {
        if (!$layout) {
            $layout  = new \Block\Core\Layout();
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

    public function setRequest(\Model\Core\Request $request = null) {
        if (!$request) {
            $request = new \Model\Core\Request();
        }
        $this->request = $request;
        return $this;
    }

    public function getResponse() {
        if (!$this->response) {
            $this->setResponse();
        }
        return $this->response;
    }

    public function setResponse(\Model\Core\Response $response = null) {
        if (!$response) {
            $response = new \Model\Core\Response;
        }
        $this->response = $response;
        return $this;
    }
}