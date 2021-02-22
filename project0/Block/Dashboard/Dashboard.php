<?php
// require_once ROOT.'\\Block\\Core\\Base.php';

class Block_Dashboard_Dashboard extends Block_Core_Base {
    public function __construct(Controller_Core_Base $controller) {
        $this->setTemplate(ROOT.'\\View\\dashboard\\dashboard.php');
        $this->setController($controller);
    }
}