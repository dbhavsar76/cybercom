<?php
namespace Block\Admin\Product\Edit\Tab;

use Model\Core\Request;

class GroupPrice extends \Block\Core\Template {
    public function __construct() {
        $this->setTemplate('/admin/product/edit/tab/group_price.php');

        $product = (new \Model\Product);
        $pPrimaryKey = $product->getPrimaryKey();
        $id = (new Request)->getGet($pPrimaryKey);
        $product->load($id);

        $groupPrice = new \Model\Product\Group\Price;

        $this->groupPrices = $groupPrice->loadAll(['productId' => $product->$pPrimaryKey]);
        $this->productPrice = $product->price;
    }
}