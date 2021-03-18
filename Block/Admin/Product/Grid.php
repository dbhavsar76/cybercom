<?php
namespace Block\Admin\Product;

class Grid extends \Block\Core\Template {
    public function __construct() {
        parent::__construct();
        $this->setTemplate('/admin/product/grid.php');

        $this->products = (new \Model\Product)->loadAll();
    }
}