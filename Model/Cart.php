<?php
namespace Model;

class Cart extends Core\Table {
    public function __construct() {
        parent::__construct();
        $this->setTableName('cart');
        $this->setPrimaryKey('cartId');
    }

    public function getItems() {
        if (!$this->getId()) {
            return false;
        }
        return \Mage::getModel('cart_item')->loadAll(["`{$this->getPrimaryKey()}` = {$this->getId()}"]);
    }

    public function getBillingAddress() {
        if (!$this->getId()) {
            return false;
        }
        $cartAddress = \Mage::getModel('cart_address');
        $addressType = $cartAddress::TYPE_BILLING;
        return $cartAddress->load(null, ["`cartId` = {$this->getId()}", "`type` = '{$addressType}'"]);
    }

    public function getShippingAddress() {
        if (!$this->getId()) {
            return false;
        }
        $cartAddress = \Mage::getModel('cart_address');
        $addressType = $cartAddress::TYPE_SHIPPING;
        return $cartAddress->load(null, ["`cartId` = {$this->getId()}", "`type` = '{$addressType}'"]);
    }
}