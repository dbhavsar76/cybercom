<?php

require_once ROOT.'\\Model\\Core\\Request.php';

class Controller_Core_Front {
    public static function init() {
        try {
            $req = new Model_Core_Request();
            $controllerName = ucfirst($req->getGet('c', 'dashboard'));
            $actionName = $req->getGet('a','dashboard') . 'Action';
    
            require_once ROOT."\\Controller\\{$controllerName}.php";
            $controllerName = 'Controller_'.$controllerName;
            $controller = new $controllerName();
            $controller->$actionName();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}