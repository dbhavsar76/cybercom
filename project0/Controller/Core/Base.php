<?php

abstract class Base {
    public function getUrl($actionName = NULL, $controllerName = NULL, array $additionalParams = NULL) {
        if (!$actionName) $actionName = $_GET['a'];
        if (!$controllerName) $controllerName = ucfirst($_GET['c']);
        $url = BASE_URL."\index.php?c={$controllerName}&a={$actionName}";
        if ($additionalParams) {
            foreach ($additionalParams as $param => $value) {
                $url .= "&{$param}={$value}";
            }
        }

        return $url;
    }

    public function redirect($actionName = NULL, $controllerName = NULL) {
        header('location:' . $this->getUrl($actionName, $controllerName));
        exit(0);
    }
}