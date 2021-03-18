<?php
namespace Block\Core\Edit\Tab;

class Attributes extends \block\Core\Template {
    public function __construct() {
        parent::__construct();
        $this->setTemplate('/core/edit/tab/attribute.php');
    }
}