<?php

class Block_PaymentMethod_Grid extends Block_Core_Template {
    public function __construct() {
        parent::__construct();
        $this->setTemplate('/paymentmethod/grid.php');

        $this->paymentMethods = (new Model_PaymentMethod)->loadAll();
    }
}