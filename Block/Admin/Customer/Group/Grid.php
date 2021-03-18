<?php
namespace Block\Admin\Customer\Group;

class Grid extends \Block\Core\Template {
    public function __construct() {
        parent::__construct();
        $this->setTemplate('/admin/customer/group/grid.php');

        $this->customerGroups = (new \Model\Customer\Group)->loadAll();
    }
}