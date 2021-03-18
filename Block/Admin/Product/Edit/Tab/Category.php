<?php
namespace Block\Admin\Product\Edit\Tab;

class Category extends \Block\Core\Template {
    public function __construct($id = null) {
        parent::__construct();
        $this->setTemplate('/admin/product/edit/tab/category.php');

        $product = new \Model\Product();
        if ($id && !$product->load($id)) {
            throw new \Exception('Id not found.');
        }
        $this->product = $product;
        $this->categories = $product->getCategories();
    }
}