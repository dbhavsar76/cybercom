<?php

class Block_Customer_Form extends Block_Core_Form {
    public function __construct(int $id = null) {
        parent::__construct($id);
        $this->setTemplate('/customer/add_edit_form.php');
    }
}