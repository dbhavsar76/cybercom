<?php

class Block_Admin_Grid extends Block_Core_Template {
    public function __construct() {
        parent::__construct();
        $this->setTemplate('/admin/grid.php');
        
        $this->admins = (new Model_Admin)->loadAll();
    } 
}