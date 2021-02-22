<?php
// require_once ROOT.'\\Block\\Core\\Base.php';
// require_once ROOT.'\\Model\\Customer.php';

class Block_Customer_Grid extends Block_Core_Base {
    public function __construct(Controller_Core_Base $controller) {
        parent::__construct();
        $this->setTemplate(ROOT.'\\View\\customer\\grid.php');
        $this->setController($controller);

        $this->customers = (new Model_Customer)->load();
    }
}