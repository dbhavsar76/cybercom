<?php

$root = 'D:\\xampp\\htdocs\\cybercom\\project\\';

function classAutoloader($classname) {
    global $root;
    $target = $root . 'classes\\' .str_replace('\\', DIRECTORY_SEPARATOR, $classname) . '.class.php';

    if (!file_exists($target)) {
        return false;
    }

    include $target;
    return true;
}

spl_autoload_register('classAutoloader');