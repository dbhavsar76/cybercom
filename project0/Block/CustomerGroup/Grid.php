<?php

class Block_CustomerGroup_Grid extends Block_Core_Template {
    public function __construct() {
        parent::__construct();
        $this->setTemplate('/customer_group/grid.php');

        $this->customerGroups = (new Model_CustomerGroup)->loadAll();
    }
}