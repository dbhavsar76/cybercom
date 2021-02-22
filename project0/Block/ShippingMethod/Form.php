<?php
// require_once ROOT.'\\Block\\Core\\Base.php';
// require_once ROOT.'\\Model\\ShippingMethod.php';

class Block_ShippingMethod_Form extends Block_Core_Base {
    public function __construct(Controller_Core_Base $controller, $id = null) {
        parent::__construct();
        $this->setTemplate(ROOT.'\\View\\shippingmethod\\addEditForm.php');
        $this->setController($controller);

        $model = new Model_ShippingMethod();

        if ($id) {
            $model->load($id);
            $this->formMode = 'Edit';
            $this->formAction = $this->getUrl('save');
            $this->statusState = 'checked';
        } else {
            $this->formMode = 'Add';
            $this->formAction = $this->getUrl('save', null, null, true);
            $this->statusState = $model->status === Model_ShippingMethod::STATUS_DISABLED ? '' : 'checked';
        }
        $this->shippingMethod = $model;
    }
}