<?php
namespace Block\Admin\ShippingMethod;

class Grid extends \Block\Core\Template {
    public function __construct() {
        parent::__construct();
        $this->setTemplate('/admin/shippingmethod/grid.php');

        $this->shippingMethods = (new \Model\ShippingMethod)->loadAll();
    }
}