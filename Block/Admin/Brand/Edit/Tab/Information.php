<?php
namespace Block\Admin\Brand\Edit\Tab;

use Model\Brand;

class Information extends \Block\Core\Template {
    public function __construct($id = null) {
        parent::__construct();
        $this->setTemplate('/admin/brand/edit/tab/information.php');

        $brand = new Brand();
        if ($id && !$brand->load($id)) {
            throw new \Exception('Id not found.');
        }

        $this->brand = $brand;
    }
}