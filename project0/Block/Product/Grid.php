<?php
require_once ROOT.'\\Block\\Core\\Base.php';
require_once ROOT.'\\Model\\Product.php';

class Block_Product_Grid extends Block_Core_Base {
    public function __construct(Controller_Core_Base $controller) {
        $this->setTemplate(ROOT.'\\View\\Product\\grid.php');
        $this->setController($controller);

        $this->products = (new Model_Product)->load();
    }
}