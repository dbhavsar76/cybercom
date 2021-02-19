<?php
require_once ROOT.'\\Block\\Core\\Base.php';

class Block_Footer extends Block_Core_Base {
    public function __construct() {
        $this->setTemplate(ROOT.'\\View\\footer.php');
    }
}