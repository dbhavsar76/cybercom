<?php
namespace Block\Admin;

class Header extends \Block\Core\Template {
    public function __construct() {
        parent::__construct();
        $this->setTemplate('/admin/header.php');
    }
}