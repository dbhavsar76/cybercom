<?php
namespace Block\Admin\Entity\Attribute\Edit\Tab;

class Information extends \Block\Core\Template {
    public function __construct($id = null) {
        parent::__construct();
        $this->setTemplate('/admin/entity/attribute/edit/tab/information.php');

        $attribute = new \Model\Entity\Attribute();
        if ($id && !$attribute->load($id)) {
            throw new \Exception('Id not found.');
        }

        $this->attribute = $attribute;
        $this->entityTypes = (new \Model\Entity\Type)->loadAll();
    }
}