<?php
namespace Block\Admin\Cart\View;

use Mage;

class Addresses extends \Block\Core\Template {
    public function __construct() {
        parent::__construct();
        $this->setTemplate('/admin/cart/view/addresses.php');

        $this->prepareAddresses();
        $this->prepareMethods();
    }

    public function prepareAddresses() {
        $cart = Mage::getRegistry('current_cart');
        $customerId = Mage::getRegistry('current_customer');

        $billingAddress = $cart->getBillingAddress();
        if (!$billingAddress) {
            $customer = Mage::getModel('customer');
            $customer->{$customer->getPrimaryKey()} = $customerId;
            $customerBillingAddress = $customer->getBillingAddress();
            $billingAddress = Mage::getModel('cart_address');
            if ($customerBillingAddress) {
                $addressData = $customerBillingAddress->getData();
                unset($addressData[$customerBillingAddress->getPrimaryKey()]);
                unset($addressData['customerId']);
                $addressData['cartId'] = $cart->getId();
                $billingAddress->setData($addressData);
                $id = $billingAddress->save();
                $billingAddress->{$billingAddress->getPrimaryKey()} = $id;
            }
        }
        $this->billingAddress = $billingAddress;

        $shippingAddress = $cart->getShippingAddress();
        if (!$shippingAddress) {
            $customer = Mage::getModel('customer');
            $customer->{$customer->getPrimaryKey()} = $customerId;
            $customerShippingAddress = $customer->getShippingAddress();
            $shippingAddress = Mage::getModel('cart_address');
            if ($customerShippingAddress) {
                $addressData = $customerShippingAddress->getData();
                unset($addressData[$customerShippingAddress->getPrimaryKey()]);
                unset($addressData['customerId']);
                $addressData['cartId'] = $cart->getId();
                $shippingAddress->setData($addressData);
                $id = $shippingAddress->save();
                $shippingAddress->{$shippingAddress->getPrimaryKey()} = $id;
            }
        }
        $this->shippingAddress = $shippingAddress;
    }

    public function prepareMethods() {
        $paymentMethod = Mage::getModel('paymentMethod');
        $paymentMethodType = $paymentMethod::STATUS_ENABLED;
        $this->paymentMethods = $paymentMethod->loadAll(["`status` = '{$paymentMethodType}'"]);
        $shippingMethod = Mage::getModel('shippingMethod');
        $shippingMethodType = $shippingMethod::STATUS_ENABLED;
        $this->shippingMethods = $shippingMethod->loadAll(["`status` = '{$shippingMethodType}'"]);
    }
}