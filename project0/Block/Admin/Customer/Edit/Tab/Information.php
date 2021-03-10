<?php
namespace Block\Admin\Customer\Edit\Tab;

class Information extends \Block\Core\Template {
    public function __construct(int $id = null) {
        parent::__construct();
        $this->setTemplate('/admin/customer/edit/tab/information.php');

        $customer = new \Model\Customer();
        if ($id && !$customer->load($id)) {
            throw new \Exception('Id not found.');
        }
        $this->customer = $customer;
        $this->statusState = $customer->status == \Model\Customer::STATUS_DISABLED ? '' : 'checked';
    }
}