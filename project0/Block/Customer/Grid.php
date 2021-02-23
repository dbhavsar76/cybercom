<?php

class Block_Customer_Grid extends Block_Core_Template {
    public function __construct() {
        parent::__construct();
        $this->setTemplate('/customer/grid.php');

        $this->customers = (new Model_Customer)->loadAll();
    }
}