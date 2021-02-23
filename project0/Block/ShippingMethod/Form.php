<?php

class Block_ShippingMethod_Form extends Block_Core_Template {
    public function __construct($id = null) {
        parent::__construct();
        $this->setTemplate('/shippingmethod/addEditForm.php');

        $model = new Model_ShippingMethod();

        if ($id) {
            $model->load($id);
            $this->formMode = 'Edit';
            $this->formAction = Model_Core_UrlManager::getUrl('save');
            $this->statusState = 'checked';
        } else {
            $this->formMode = 'Add';
            $this->formAction = Model_Core_UrlManager::getUrl('save', null, null, true);
            $this->statusState = $model->status === Model_ShippingMethod::STATUS_DISABLED ? '' : 'checked';
        }
        $this->shippingMethod = $model;
    }
}