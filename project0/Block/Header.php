<?php
require_once ROOT.'\\Block\\Core\\Base.php';

class Block_Header extends Block_Core_Base {
    public function __construct(Controller_Core_Base $controller) {
        $this->setTemplate(ROOT.'\\View\\header.php');
        $this->setController($controller);
    }
}