<?php

class Block_ShippingMethod_Form extends Block_Core_Form {
    public function __construct($id = null) {
        parent::__construct($id);
        $this->setTemplate('/shippingmethod/add_edit_form.php');
    }
}