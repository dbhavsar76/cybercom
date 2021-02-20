<?php

abstract class Controller_Core_Base {

    private $req = null;
    private $context = [];

    function __construct() {
        $this->req = new Model_Core_Request();
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
        if (!$this->req) $this->req = new Model_Core_Request();
        return $this->req;
    }

    public function getUrl($actionName = NULL, $controllerName = NULL, array $additionalParams = null, $reset = false) {
        $params = $reset ? [] : $_GET;

        if (!$actionName) $actionName = $_GET['a'];
        if (!$controllerName) $controllerName = ucfirst($_GET['c']);
        $params['a'] = $actionName;
        $params['c'] = $controllerName;
        if ($additionalParams)
            $params = array_merge($params, $additionalParams);
        $queryString = http_build_query($params);
        unset($params);
        return  BASE_URL."\index.php?".$queryString;
    }

    public function redirect($actionName = NULL, $controllerName = NULL, array $additionalParams = null, $reset = false) {
        header('location:' . $this->getUrl($actionName, $controllerName, $additionalParams, $reset));
        exit(0);
    }

}