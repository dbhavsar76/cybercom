<?php
define('ROOT', 'D:/xampp/htdocs/cybercom/project0');
define('BASE_URL', 'http://localhost/cybercom/project0');

function classAutoLoader($classname) {
    $target = ROOT . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $classname) . '.php';

    if (!file_exists($target)) {
        return false;
    }

    require $target;
    return true;
}
spl_autoload_register('classAutoLoader');

class Mage {
    public static function init() {
        try {
            self::getController('core_front')::init();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public static function getController($controllerName, $cached = false) {
        $controllerName = self::prepareClassName('controller', $controllerName);
        if ($cached && self::existsRegistry($controllerName)) {
            return self::getRegistry($controllerName);
        }
        $controller = new $controllerName();
        if ($cached) {
            self::setRegistry($controllerName, $controller);
        }
        return $controller;
    }

    public static function getModel($modelName, $cached = false) {
        $modelName = self::prepareClassName('model', $modelName);
        if ($cached && self::existsRegistry($modelName)) {
            return self::getRegistry($modelName);
        }
        $model = new $modelName();
        if ($cached) {
            self::setRegistry($modelName, $model);
        }
        return $model;
    }

    public static function getBlock($blockName, $cached = false) {
        $blockName = self::prepareClassName('block', $blockName);
        if ($cached && self::existsRegistry($blockName)) {
            return self::getRegistry($blockName);
        }
        $block = new $blockName();
        if ($cached) {
            self::setRegistry($blockName, $block);
        }
        return $block;
    }

    public static function prepareClassName($key, $namespace) {
        $className = $key.' '.$namespace;
        $className = str_replace('\\', ' ', $className);
        $className = str_replace('_', ' ', $className);
        $className = ucwords($className);
        $className = str_replace(' ', '\\', $className);
        return '\\'.$className;
    }

    public static function setRegistry($key, $value) {
        $GLOBALS[$key] = $value;
    }

    public static function getRegistry($key) {
        if (!self::existsRegistry($key)) {
            return null;
        }
        return $GLOBALS[$key];
    }

    public static function existsRegistry($key) {
        return array_key_exists($key, $GLOBALS);
    }
}

Mage::init();