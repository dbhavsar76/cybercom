<?php

class Block_Admin_Form_Tab_Permission extends Block_Core_Template {
    public function __construct() {
        parent::__construct();
        $this->setTemplate('/admin/form/tab/permission.php');
    }
}