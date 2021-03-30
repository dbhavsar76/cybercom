<?php
namespace Model\Customer;

class Address extends \Model\Core\Table {
    public const TYPE_BILLING = 'billing';
    public const TYPE_SHIPPING = 'shipping';

    public function __construct() {
        parent::__construct();
        $this->setTableName('customer_address');
        $this->setPrimaryKey('addressId');
    }
}