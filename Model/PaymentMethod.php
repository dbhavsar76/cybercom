<?php
namespace Model;

class PaymentMethod extends \Model\Core\Table {
    public const STATUS_ENABLED = 1;
    public const STATUS_DISABLED = 0;

    public function __construct() {
        parent::__construct();
        $this->setTableName('paymentmethod');
        $this->setPrimaryKey('id');
    }
}