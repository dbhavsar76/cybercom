<?php
namespace Block\Admin\Customer;

class Grid extends \Block\Core\Template {
    public function __construct() {
        parent::__construct();
        $this->setTemplate('/admin/customer/grid.php');

        $this->customers = (new \Model\Customer)->loadAll();
    }
}