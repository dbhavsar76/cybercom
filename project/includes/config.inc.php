<?php

define('ROOT', 'D:\\xampp\\htdocs\\cybercom\\project\\');
define('BASE_URL', 'http://localhost/cybercom/project/');

function classAutoloader($classname) {
    $target = ROOT . 'classes\\' .str_replace('\\', DIRECTORY_SEPARATOR, $classname) . '.class.php';

    if (!file_exists($target)) {
        return false;
    }

    include $target;
    return true;
}
spl_autoload_register('classAutoloader');