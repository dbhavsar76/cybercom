<?php

class Block_Category_Form extends Block_Core_Form {
    public function __construct(int $id = null) {
        parent::__construct($id);
        $this->setTemplate('/category/add_edit_form.php');
    }
}