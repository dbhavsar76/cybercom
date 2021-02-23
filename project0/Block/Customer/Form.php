<?php

class Block_Customer_Form extends Block_Core_Template {
    public function __construct(int $id = null) {
        parent::__construct();
        $this->setTemplate('/customer/addEditForm.php');

        $customer = new Model_Customer();
        if ($id) {
            $customer->load($id);
            $this->formMode = 'Edit';
            $this->formAction = Model_Core_UrlManager::getUrl('save');
            $this->statusState = $customer->status == Model_Customer::STATUS_DISABLED ? '' : 'checked'; 
        } else {
            $this->formMode = 'Add';
            $this->formAction = Model_Core_UrlManager::getUrl('save', null, null, true);
            $this->statusState = 'checked';
        }
        $this->customer = $customer;
    }
}