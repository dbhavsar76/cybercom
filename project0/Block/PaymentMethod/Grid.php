<?php
// require_once ROOT.'\\Block\\Core\\Base.php';
// require_once ROOT.'\\Model\\PaymentMethod.php';

class Block_PaymentMethod_Grid extends Block_Core_Base {
    public function __construct(Controller_Core_Base $controller) {
        parent::__construct();
        $this->setTemplate(ROOT.'\\View\\paymentmethod\\grid.php');
        $this->setController($controller);

        $this->paymentMethods = (new Model_PaymentMethod)->load();
    }
}