<?php

class Block_Product_Form extends Block_Core_Template {
    public function __construct(int $id = null) {
        $this->setTemplate('/product/addEditForm.php');

        $product = new Model_Product();
        if ($id) {
            $product->load($id);
            $this->formMode = 'Edit';
            $this->formAction = Model_Core_UrlManager::getUrl('save');
            $this->statusState = $product->status == Model_Product::STATUS_DISABLED ? '' : 'checked';
        } else {
            $this->formMode = 'Add';
            $this->formAction = Model_Core_UrlManager::getUrl('save', null, null, true);
            $this->statusState = 'checked';
        }
        $this->product = $product;
    }
}