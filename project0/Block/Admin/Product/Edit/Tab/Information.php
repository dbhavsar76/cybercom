<?php
namespace Block\Admin\Product\Edit\Tab;

class Information extends \Block\Core\Template {
    public function __construct($id = null) {
        parent::__construct();
        $this->setTemplate('/admin/product/edit/tab/information.php');

        $product = new \Model\Product();
        if ($id && !$product->load($id)) {
            throw new \Exception('Id not found.');
        }
        $this->product = $product;
        $this->statusState = $product->status == \Model\Product::STATUS_DISABLED ? '' : 'checked';
    }
}