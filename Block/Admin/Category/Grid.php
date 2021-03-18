<?php
namespace Block\Admin\Category;

class Grid extends \Block\Core\Template {
    public function __construct() {
        parent::__construct();
        $this->setTemplate('/admin/category/grid.php');
        
        $category = new \Model\Category;
        $this->categories = $category->loadAll(null, ['`path` ASC']);
    } 
}