<?php

class Block_Category_Grid extends Block_Core_Template {
    public function __construct() {
        parent::__construct();
        $this->setTemplate('/category/grid.php');
        
        $this->categories = (new Model_Category)->loadAllTree();
    } 
}