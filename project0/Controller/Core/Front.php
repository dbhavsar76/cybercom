<?php

require_once ROOT.'\\Model\\Request.php';

class Front {
    public static function init() {
        try {
            $req = new Request();
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