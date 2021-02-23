<?php
define('ROOT', 'D:/xampp/htdocs/cybercom/project0');
define('BASE_URL', 'http://localhost/cybercom/project0');

function classAutoLoader($classname) {
    $target = ROOT . DIRECTORY_SEPARATOR . str_replace('_', DIRECTORY_SEPARATOR, $classname) . '.php';

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
            Controller_Core_Front::init();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}

Mage::init();