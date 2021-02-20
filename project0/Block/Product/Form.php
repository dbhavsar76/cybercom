<?php
require_once ROOT.'\\Block\\Core\\Base.php';
require_once ROOT.'\\Model\\Product.php';

class Block_Product_Form extends Block_Core_Base {
    public function __construct(Controller_Core_Base $controller, int $id = null) {
        $this->setTemplate(ROOT.'\\View\\Product\\addEditForm.php');
        $this->setController($controller);

        $product = new Model_Product();
        if ($id) {
            $product->load($id);
            $this->formMode = 'Edit';
            $this->formAction = $this->getUrl('save');
            $this->statusState = $product->status == Model_Product::STATUS_DISABLED ? '' : 'checked';
        } else {
            $this->formMode = 'Add';
            $this->formAction = $this->getUrl('save', null, null, true);
            $this->statusState = 'checked';
        }
        $this->product = $product;
    }
}