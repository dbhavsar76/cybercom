<?php
define('ROOT', 'D:\\xampp\\htdocs\\cybercom\\project0');
define('BASE_URL', 'http://localhost/cybercom/project0');

require_once ROOT.'\\Controller\\Core\\Front.php';

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