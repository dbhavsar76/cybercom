<?php
require_once ROOT.'\\Block\\Core\\Base.php';
require_once ROOT.'\\Model\\ShippingMethod.php';

class Block_ShippingMethod_Grid extends Block_Core_Base {
    public function __construct(Controller_Core_Base $controller) {
        parent::__construct();
        $this->setTemplate(ROOT.'\\View\\ShippingMethod\\grid.php');
        $this->setController($controller);

        $this->shippingMethods = (new Model_ShippingMethod)->load();
    }
}