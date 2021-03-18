<?php
namespace Model\Entity;

class Type extends \Model\Core\Table {
    public function __construct() {
        parent::__construct();
        $this->setTableName('entity_type');
        $this->setPrimaryKey('entityTypeId');
    }

    public function getMapping() {
        $entityTypes = $this->loadAll();
        $mapping = [];
        foreach ($entityTypes as $entityType) {
            $mapping[$entityType->{$this->getPrimaryKey()}] = $entityType->name;
        }
        return $mapping;
    }
}