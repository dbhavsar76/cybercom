<?php
namespace Block\Admin\Admin\Edit\Tab;

class Information extends \Block\Core\Template {
    public function __construct(int $id = null) {
        parent::__construct();
        $this->setTemplate('/admin/admin/edit/tab/information.php');

        $admin = new \Model\Admin();
        if ($id && !$admin->load($id)) {
            throw new \Exception('Id not found.');
        }
        $this->admin = $admin;
        $this->statusState = $admin->status == \Model\Admin::STATUS_DISABLED ? '' : 'checked';
    }
}