<?php

class Block_Footer extends Block_Core_Template {
    public function __construct() {
        parent::__construct();
        $this->setTemplate('/footer.php');
    }
}