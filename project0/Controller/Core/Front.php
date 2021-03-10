<?php

namespace Controller\Core;

class Front {
    public static function init() {
        try {
            $request = new \Model\Core\Request();
            $controllerName = ucfirst($request->getGet('c', 'dashboard'));
            $actionName = $request->getGet('a','index') . 'Action';
    
            $controllerName = self::prepareClassName('controller\\Admin', $controllerName);
            $controller = new $controllerName();
            $controller->$actionName();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public static function prepareClassName($key, $namespace) {
        $className = $key.' '.$namespace;
        $className = str_replace('\\', ' ', $className);
        $className = str_replace('_', ' ', $className);
        $className = ucwords($className);
        $className = str_replace(' ', '\\', $className);
        return '\\'.$className;
    }
}