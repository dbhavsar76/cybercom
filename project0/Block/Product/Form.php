<?php

class Block_Product_Form extends Block_Core_Form {
    public function __construct(int $id = null) {
        parent::__construct($id);
        $this->setTemplate('/product/add_edit_form.php');
    }
}