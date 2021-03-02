<?php

class Block_CustomerGroup_Form extends Block_Core_Form {
    public function __construct(int $id = null) {
        parent::__construct($id);
        $this->setTemplate('/customer_group/add_edit_form.php');
    }
}