<?php
namespace Model\Entity\Attribute;

class Option extends \Model\Core\Table {
    public function __construct() {
        parent::__construct();
        $this->setTableName('entity_attribute_option');
        $this->setPrimaryKey('optionId');
    }

    public function insertMultiple($attributeId, $optionsData) {
        if (empty($optionsData)) {
            return true;
        }

        $values = [];
        foreach ($optionsData as $optionData) {
            $values[] = "({$attributeId}, '{$optionData['name']}', '{$optionData['sortOrder']}')";
        }
        $sql = "INSERT INTO `{$this->getTableName()}`(`attributeId`,`name`,`sortOrder`) VALUES " . implode(',', $values);
        return $this->getAdapter()->insert($sql);
    }

    public function removeMultiple($ids) {
        if (empty($ids)) {
            return false;
        }

        $sql = "DELETE FROM `{$this->getTableName()}` WHERE `{$this->getPrimaryKey()}` IN ({$ids})";
        return $this->getAdapter()->delete($sql);
    }
}