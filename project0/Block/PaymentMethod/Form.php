<?php
// require_once ROOT.'\\Block\\Core\\Base.php';
// require_once ROOT.'\\Model\\PaymentMethod.php';

class Block_PaymentMethod_Form extends Block_Core_Base {
    public function __construct(Controller_Core_Base $controller, int $id = null) {
        $this->setTemplate(ROOT.'\\View\\paymentmethod\\addEditForm.php');
        $this->setController($controller);

        $paymentMethod = new Model_PaymentMethod();
        if ($id) {
            $paymentMethod->load($id);
            $this->formMode = 'Edit';
            $this->formAction = $this->getUrl('save');
            $this->statusState = $paymentMethod->status == Model_PaymentMethod::STATUS_DISABLED ? '' : 'checked';
        } else {
            $this->formMode = 'Add';
            $this->formAction = $this->getUrl('save', null, null, true);
            $this->statusState = 'checked';
        }
        $this->paymentMethod = $paymentMethod;
    }
}