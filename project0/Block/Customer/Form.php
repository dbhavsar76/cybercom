<?php
require_once ROOT.'\\Block\\Core\\Base.php';
require_once ROOT.'\\Model\\Customer.php';

class Block_Customer_Form extends Block_Core_Base {
    public function __construct(Controller_Core_Base $controller, int $id = null) {
        parent::__construct();
        $this->setTemplate(ROOT.'\\View\\customer\\addEditForm.php');
        $this->setController($controller);

        $customer = new Model_Customer();
        if ($id) {
            $customer->load($id);
            $this->formMode = 'Edit';
            $this->formAction = $this->getUrl('save');
            $this->statusState = $customer->status == Model_Customer::STATUS_DISABLED ? '' : 'checked'; 
        } else {
            $this->formMode = 'Add';
            $this->formAction = $this->getUrl('save', null, null, true);
            $this->statusState = 'checked';
        }
        $this->customer = $customer;
    }
}