<?php
namespace Block\Home;

class Home extends \Block\Core\Template {
    public function __construct() {
        parent::__construct();
        $this->setTemplate('/home/home.php');
    }
}