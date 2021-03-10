<?php
namespace Block\Admin\Product\Edit\Tab;

class Media extends \Block\Core\Template {
    public function __construct() {
        parent::__construct();
        $this->setTemplate('/admin/product/edit/tab/media.php');
    }
}