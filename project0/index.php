<?php
define('ROOT', 'D:\\xampp\\htdocs\\cybercom\\project0');
define('BASE_URL', 'http://localhost/cybercom/project0');

require_once 'Controller/Core/Front.php';

class Mage {
    public static function init() {
        Front::init();
    }
}

Mage::init();