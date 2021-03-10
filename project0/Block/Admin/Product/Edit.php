<?php
namespace Block\Admin\Product;

class Edit extends \Block\Core\Edit {
    public function __construct(int $id = null) {
        parent::__construct($id);
        $this->title = 'Product';
    }
}