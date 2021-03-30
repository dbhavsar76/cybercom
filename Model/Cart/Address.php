<?php
namespace Model\Cart;

class Address extends \Model\Core\Table {
    public const TYPE_BILLING = 'billing';
    public const TYPE_SHIPPING = 'shipping';

    public function __construct() {
        parent::__construct();
        $this->setTableName('cart_address');
        $this->setPrimaryKey('cartAddressId');
    }
}