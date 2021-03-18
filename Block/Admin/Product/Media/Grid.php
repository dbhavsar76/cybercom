<?php
namespace Block\Admin\Product\Media;

class Grid extends \Block\Core\Template {
    public function __construct() {
        parent::__construct();
        $this->setTemplate('/admin/product/media/grid.php');

        $productId = (new \Model\Core\Request)->getGet((new \Model\Product)->getPrimaryKey());
        $this->media = (new \Model\Product\Media)->loadAll(["`productId`={$productId}"]);
    }
}