<?php
namespace Block\Admin\Customer\Edit\Tab;

class Address extends \Block\Core\Template {
    public function __construct() {
        parent::__construct();
        $this->setTemplate('/admin/customer/edit/tab/address.php');

        $request = new \Model\Core\Request();
        $billingAddress = new \Model\Customer\Address();
        $shippingAddress = new \Model\Customer\Address();

        $billingAddressId = $request->getGet('billingAddressId');
        $shippingAddressId = $request->getGet('shippingAddressId');
        if (($billingAddressId && $shippingAddressId) && !($billingAddress->load($billingAddressId) && $shippingAddress->load($shippingAddressId))) {
            throw new \Exception('Id not found.');
        }

        $this->billingAddress = $billingAddress;
        $this->shippingAddress = $shippingAddress;
    }
}