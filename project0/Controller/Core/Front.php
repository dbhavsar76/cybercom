<?php

class Controller_Core_Front {
    public static function init() {
        try {
            $request = new Model_Core_Request();
            $controllerName = ucfirst($request->getGet('c', 'dashboard'));
            $actionName = $request->getGet('a','dashboard') . 'Action';
    
            $controllerName = 'Controller_'.$controllerName;
            $controller = new $controllerName();
            $controller->$actionName();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}