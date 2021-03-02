<?php

class Block_Admin_Form_Tab_Information extends Block_Core_Template {
    public function __construct(int $id = null) {
        parent::__construct();
        $this->setTemplate('/admin/form/tab/information.php');

        $admin = new Model_Admin();
        if ($id) {
            if (!$admin->load($id)) {
                throw new Exception('Id not found.');
            }
        }
        $this->admin = $admin;
        $this->statusState = $admin->status == Model_Admin::STATUS_DISABLED ? '' : 'checked';
    }
}