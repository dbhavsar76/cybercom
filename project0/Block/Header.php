<?php

class Block_Header extends Block_Core_Template {
    public function __construct() {
        $this->setTemplate('/header.php');
    }
}