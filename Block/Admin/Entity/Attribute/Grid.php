<?php
namespace Block\Admin\Entity\Attribute;

class Grid extends \Block\Core\Template {
    public function __construct() {
        parent::__construct();
        $this->setTemplate('/admin/entity/attribute/grid.php');

        $this->attributes = (new \Model\Entity\Attribute)->loadAll();
    }
}