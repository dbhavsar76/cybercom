<?php

class Block_PaymentMethod_Form extends Block_Core_Template {
    public function __construct(int $id = null) {
        $this->setTemplate('/paymentmethod/addEditForm.php');

        $paymentMethod = new Model_PaymentMethod();
        if ($id) {
            $paymentMethod->load($id);
            $this->formMode = 'Edit';
            $this->formAction = Model_Core_UrlManager::getUrl('save');
            $this->statusState = $paymentMethod->status == Model_PaymentMethod::STATUS_DISABLED ? '' : 'checked';
        } else {
            $this->formMode = 'Add';
            $this->formAction = Model_Core_UrlManager::getUrl('save', null, null, true);
            $this->statusState = 'checked';
        }
        $this->paymentMethod = $paymentMethod;
    }
}