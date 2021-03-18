<?php
namespace Block\Admin\PaymentMethod;

class Grid extends \Block\Core\Template {
    public function __construct() {
        parent::__construct();
        $this->setTemplate('/admin/paymentmethod/grid.php');

        $this->paymentMethods = (new \Model\PaymentMethod)->loadAll();
    }
}