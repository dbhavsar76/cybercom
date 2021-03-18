<?php
namespace Block\Admin\Category;

class Edit extends \Block\Core\Edit {
    public function __construct($id = null) {
        parent::__construct($id);
        $this->title = 'Category';
    }
}