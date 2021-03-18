<?php
namespace Block;

class Footer extends \Block\Core\Template {
    public function __construct() {
        parent::__construct();
        $this->setTemplate('/footer.php');
    }
}