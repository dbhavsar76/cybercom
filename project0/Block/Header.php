<?php

class Block_Header extends Block_Core_Template {
    public function __construct() {
        parent::__construct();
        $this->setTemplate('/header.php');
    }
}