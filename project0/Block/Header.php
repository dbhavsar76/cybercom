<?php
namespace Block;

class Header extends Core\Template {
    public function __construct() {
        parent::__construct();
        $this->setTemplate('/header.php');
    }
}