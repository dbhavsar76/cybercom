<?php
namespace Block\Admin;

class Layout extends \Block\Core\Layout {
    public function __construct() {
        parent::__construct();
        $this->setTemplate('/admin/layout/three_column.php');
    }
}