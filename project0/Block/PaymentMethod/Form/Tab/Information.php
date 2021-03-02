<?php

class Block_PaymentMethod_Form_Tab_Information extends Block_Core_Template {
    public function __construct(int $id = null) {
        parent::__construct();
        $this->setTemplate('/paymentmethod/form/tab/information.php');

        $paymentMethod = new Model_PaymentMethod();
        if ($id) {
            if (!$paymentMethod->load($id)) {
                throw new Exception('Id not found.');
            }
        }
        $this->paymentMethod = $paymentMethod;
        $this->statusState = $paymentMethod->status == Model_PaymentMethod::STATUS_DISABLED ? '' : 'checked';
    }
}