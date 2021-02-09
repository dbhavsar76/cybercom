<?php

define('BASE_URL', '/cybercom/php_core/');

function class_autoloader($classname) {
    $root = 'D:\\xampp\\htdocs\\cybercom\\php_core\\';
    $path = $root . 'classes' . DIRECTORY_SEPARATOR;
    $ext = '.class.php';
    $full_path = $path . str_replace("\\", DIRECTORY_SEPARATOR, $classname) . $ext;

    // echo '<br>' . $full_path . ' - ' . $_SERVER['REQUEST_URI'] . '<br>';

    if (!file_exists($full_path)) return false;
    
    require $full_path;
    return true;
}

spl_autoload_register('class_autoloader');