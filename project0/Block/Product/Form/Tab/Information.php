<?php

class Block_Product_Form_Tab_Information extends Block_Core_Template {
    public function __construct(int $id = null) {
        parent::__construct();
        $this->setTemplate('/product/form/tab/information.php');

        $product = new Model_Product();
        if ($id) {
            if (!$product->load($id)) {
                throw new Exception('Id not found.');
            }
        }
        $this->product = $product;
        $this->statusState = $product->status == Model_Product::STATUS_DISABLED ? '' : 'checked';
    }
}