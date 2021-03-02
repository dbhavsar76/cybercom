<?php

class Block_CustomerGroup_Form_Tab_Information extends Block_Core_Template {
    public function __construct(int $id = null) {
        parent::__construct();
        $this->setTemplate('/customer_group/form/tab/information.php');

        $customerGroup = new Model_CustomerGroup();
        if ($id) {
            if (!$customerGroup->load($id)) {
                throw new Exception('Id not found.');
            }
        }
        $this->customerGroup = $customerGroup;
    }
}