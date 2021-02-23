<?php

class Block_ShippingMethod_Grid extends Block_Core_Template {
    public function __construct() {
        parent::__construct();
        $this->setTemplate('/shippingmethod/grid.php');

        $this->shippingMethods = (new Model_ShippingMethod)->loadAll();
    }
}