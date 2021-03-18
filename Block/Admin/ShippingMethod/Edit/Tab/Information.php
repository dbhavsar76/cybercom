<?php
namespace Block\Admin\ShippingMethod\Edit\Tab;

class Information extends \Block\Core\Template {
    public function __construct($id = null) {
        parent::__construct();
        $this->setTemplate('/admin/shippingmethod/edit/tab/information.php');

        $shippingMethod = new \Model\ShippingMethod();
        if ($id && !$shippingMethod->load($id)) {
            throw new \Exception('Id not found.');
        }
        $this->shippingMethod = $shippingMethod;
        $this->statusState = $shippingMethod->status == \Model\ShippingMethod::STATUS_DISABLED ? '' : 'checked';
    }
}