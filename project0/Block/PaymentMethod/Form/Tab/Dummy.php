<?php

class Block_PaymentMethod_Form_Tab_Dummy extends Block_Core_Template {
    public function __construct() {
        parent::__construct();
        $this->setTemplate('/paymentmethod/form/tab/dummy.php');
    }
}