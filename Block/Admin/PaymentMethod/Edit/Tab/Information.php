<?php
namespace Block\Admin\PaymentMethod\Edit\Tab;

class Information extends \Block\Core\Template {
    public function __construct($id = null) {
        parent::__construct();
        $this->setTemplate('/admin/paymentmethod/edit/tab/information.php');

        $paymentMethod = new \Model\PaymentMethod();
        if ($id && !$paymentMethod->load($id)) {
            throw new \Exception('Id not found.');
        }
        $this->paymentMethod = $paymentMethod;
        $this->statusState = $paymentMethod->status == \Model\PaymentMethod::STATUS_DISABLED ? '' : 'checked';
    }
}