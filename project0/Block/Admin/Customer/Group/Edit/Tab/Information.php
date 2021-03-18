<?php
namespace Block\Admin\Customer\Group\Edit\Tab;

class Information extends \Block\Core\Template {
    public function __construct($id = null) {
        parent::__construct();
        $this->setTemplate('/admin/customer/group/edit/tab/information.php');

        $customerGroup = new \Model\Customer\Group();
        if ($id && !$customerGroup->load($id)) {
            throw new \Exception('Id not found.');
        }
        $this->customerGroup = $customerGroup;
    }
}