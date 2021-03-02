<?php

class Block_ShippingMethod_Form_Tab_Information extends Block_Core_Template {
    public function __construct(int $id = null) {
        parent::__construct();
        $this->setTemplate('/shippingmethod/form/tab/information.php');

        $shippingMethod = new Model_ShippingMethod();
        if ($id) {
            if (!$shippingMethod->load($id)) {
                throw new Exception('Id not found.');
            }
        }
        $this->shippingMethod = $shippingMethod;
        $this->statusState = $shippingMethod->status == Model_ShippingMethod::STATUS_DISABLED ? '' : 'checked';
    }
}