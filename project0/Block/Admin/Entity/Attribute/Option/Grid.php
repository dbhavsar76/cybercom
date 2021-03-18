<?php
namespace Block\Admin\Entity\Attribute\Option;

class Grid extends \Block\Core\Template {
    public function __construct($id) {
        parent::__construct();
        $this->setTemplate('/admin/entity/attribute/option/grid.php');

        $this->options = (new \Model\Entity\Attribute\Option)->loadAll(["`attributeId` = {$id}"], ['`sortOrder` ASC']);
    }
}