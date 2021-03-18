<?php

namespace Controller\Core;

use Mage;

class Front {
    public static function init() {
        try {
            $request = new \Model\Core\Request();
            $controllerName = $request->getGet('c', 'home');
            $actionName = $request->getGet('a','index') . 'Action';
    
            $controller = Mage::getController($controllerName);
            $controller->$actionName();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

}