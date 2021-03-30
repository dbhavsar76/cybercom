<?php
namespace Block\Admin\Cart\View;

class CustomerSelector extends \Block\Core\Template {
    public function __construct() {
        parent::__construct();
        $this->setTemplate('/admin/cart/view/customer_selector.php');

        $this->customers = \Mage::getModel('customer')->getFullNames();
        $this->currentCustomer = \Mage::getRegistry('current_customer');
    }
}