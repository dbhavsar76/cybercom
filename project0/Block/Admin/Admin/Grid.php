<?php
namespace Block\Admin\Admin;

class Grid extends \Block\Core\Template {
    public function __construct() {
        parent::__construct();
        $this->setTemplate('/admin/admin/grid.php');
        
        $this->admins = (new \Model\Admin)->loadAll();
    } 
}