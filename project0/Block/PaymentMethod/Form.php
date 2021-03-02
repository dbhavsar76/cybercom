<?php

class Block_PaymentMethod_Form extends Block_Core_Form {
    public function __construct(int $id = null) {
        parent::__construct($id);
        $this->setTemplate('/paymentmethod/add_edit_form.php');
    }
}