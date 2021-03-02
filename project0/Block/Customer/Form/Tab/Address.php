<?php

class Block_Customer_Form_Tab_Address extends Block_Core_Template {
    public function __construct() {
        parent::__construct();
        $this->setTemplate('/customer/form/tab/address.php');

        $request = new Model_Core_Request();
        $billingAddress = new Model_CustomerAddress();
        $shippingAddress = new Model_CustomerAddress();

        $billingAddressId = $request->getGet('billingAddressId');
        $shippingAddressId = $request->getGet('shippingAddressId');
        if (($billingAddressId && $shippingAddressId) && !($billingAddress->load($billingAddressId) && $shippingAddress->load($shippingAddressId))) {
            throw new Exception('Id not found.');
        }

        $this->billingAddress = $billingAddress;
        $this->shippingAddress = $shippingAddress;
    }
}