<?php
namespace Block;

class Layout extends Core\Layout {
    public function __construct() {
        parent::__construct();
        $this->setTemplate('/layout.php');
    }
}