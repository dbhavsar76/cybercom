<?php
namespace Block\Admin\Product\Edit\Tab;

class Attributes extends \Block\Core\Edit\Tab\Attributes {
    public function __construct($id = null) {
        parent::__construct();

        $product = new \Model\Product();
        if ($id && !$product->load($id)) {
            throw new \Exception('Id not found.');
        }
        $this->product = $product;
        $this->attributes = $product->getAttributes();
    }
}