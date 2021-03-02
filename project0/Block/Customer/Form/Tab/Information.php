<?php

class Block_Customer_Form_Tab_Information extends Block_Core_Template {
    public function __construct(int $id = null) {
        parent::__construct();
        $this->setTemplate('/customer/form/tab/information.php');

        $customer = new Model_Customer();
        if ($id) {
            if (!$customer->load($id)) {
                throw new Exception('Id not found.');
            }

        }
        $this->customer = $customer;
        $this->statusState = $customer->status == Model_Customer::STATUS_DISABLED ? '' : 'checked';
    }
}