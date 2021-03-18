<?php
namespace Block\Admin\Dashboard;

class Dashboard extends \Block\Core\Template {
    public function __construct() {
        parent::__construct();
        $this->setTemplate('/admin/dashboard/dashboard.php');
    }
}