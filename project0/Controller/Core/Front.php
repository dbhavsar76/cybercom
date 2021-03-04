<?php

class Controller_Core_Front {
    public static function init() {
        try {
            $request = new Model_Core_Request();
            $controllerName = ucfirst($request->getGet('c', 'dashboard'));
            $actionName = $request->getGet('a','index') . 'Action';
    
            $controllerName = self::prepareClassName('controller', $controllerName);
            $controller = new $controllerName();
            $controller->$actionName();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public static function prepareClassName($key, $namespace) {
        $className = $key.' '.$namespace;
        $className = str_replace('_', ' ', $className);
        $className = ucwords($className);
        $className = str_replace(' ', '_', $className);
        return $className;
    }
}