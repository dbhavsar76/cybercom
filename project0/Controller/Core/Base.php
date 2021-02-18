<?php

abstract class Base {

    private $req = null;

    function __construct() {
        $this->req = new Request();
    }

    public function getRequest() {
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