<?php
namespace Model;

class PaymentMethod extends \Model\Core\Table {
    public const STATUS_ENABLED = 'enabled';
    public const STATUS_DISABLED = 'disabled';

    public function __construct() {
        parent::__construct();
        $this->setTableName('paymentmethod');
        $this->setPrimaryKey('id');
    }
}