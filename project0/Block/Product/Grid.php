<?php

class Block_Product_Grid extends Block_Core_Template {
    public function __construct() {
        $this->setTemplate('/product/grid.php');

        $this->products = (new Model_Product)->loadAll();
    }
}