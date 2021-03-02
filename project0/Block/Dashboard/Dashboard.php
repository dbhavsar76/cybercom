<?php

class Block_Dashboard_Dashboard extends Block_Core_Template {
    public function __construct() {
        parent::__construct();
        $this->setTemplate('/dashboard/dashboard.php');
    }
}