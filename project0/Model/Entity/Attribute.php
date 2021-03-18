<?php
namespace Model\Entity;

use Model\Entity\Attribute\Option;

class Attribute extends \Model\Core\Table {
    public const INPUT_TYPE_TEXT = 'text';
    public const INPUT_TYPE_NUMBER = 'number';
    public const INPUT_TYPE_RADIO = 'radio';
    public const INPUT_TYPE_CHECKBOX = 'checkbox';
    public const INPUT_TYPE_SELECT = 'select';
    public const INPUT_TYPE_SELECT_MULTIPLE = 'select_multiple';

    public const BACKEND_TYPE_INT = 'INT';
    public const BACKEND_TYPE_VARCHAR = 'VARCHAR(250)';
    public const BACKEND_TYPE_DATE = 'DATE';
    public const BACKEND_TYPE_DATETIME = 'DATETIME';
    public const BACKEND_TYPE_TIMESTAMP = 'TIMESTAMP';

    public function __construct() {
        parent::__construct();
        $this->setTableName('entity_attribute');
        $this->setPrimaryKey('attributeId');
    }

    public function save() {
        # edit mode
        if (!empty($this->{$this->getPrimaryKey()})) {
            return parent::save();
        }
        # add mode
        if (empty($this->entityTypeId) || empty($this->inputTypeId) || empty($this->code) || empty($this->backendType)) {
            return false;
        }
        $entityType = (new Type)->load($this->entityTypeId);
        
        # unique code per entity check
        $sql = "SELECT COUNT(*) `exists` FROM information_schema.columns 
        WHERE TABLE_NAME='{$entityType->tableName}' 
        AND COLUMN_NAME='{$this->code}' 
        AND TABLE_SCHEMA=database()";

        $result = $this->getAdapter()->fetchRow($sql);
        if ($result['exists']) {
            return false;
        }
        #add column in the table
        $sql = "ALTER TABLE `{$entityType->tableName}` ADD COLUMN `{$this->code}` {$this->backendType} NULL";
        $result = $this->getAdapter()->update($sql);
        if ($result) {
            $result = parent::save();
        }
        return $result;
    }

    public function delete() {
        $entityType = new Type;
        $entityType->load($this->entityTypeId);
        # remove column from table
        $sql = "ALTER TABLE `{$entityType->tableName}` DROP COLUMN `{$this->code}`";
        $result = $this->getAdapter()->delete($sql);
        if ($result) {
            $result = parent::delete();
        }
        return $result;
    }

    public function getInputTypeOptions() {
        return [
            self::INPUT_TYPE_TEXT            => 'Text',
            self::INPUT_TYPE_NUMBER          => 'Number',
            self::INPUT_TYPE_RADIO           => 'Radio',
            self::INPUT_TYPE_CHECKBOX        => 'Checkbox',
            self::INPUT_TYPE_SELECT          => 'Dropdown',
            self::INPUT_TYPE_SELECT_MULTIPLE => 'Dropdown With Mutiple Selection'
        ];
    }

    public function getBackendTypeOptions() {
        return [
            self::BACKEND_TYPE_INT       => 'Integer',
            self::BACKEND_TYPE_VARCHAR   => 'Varchar (250)',
            self::BACKEND_TYPE_DATE      => 'Date',
            self::BACKEND_TYPE_DATETIME  => 'Date Time',
            self::BACKEND_TYPE_TIMESTAMP => 'Timestamp',
        ];
    }

    public function getAttributeHtml() {
        # pending
    }

    public function getOptions() {
        $option = new Option;
        return $option->loadAll(["`attributeId` = {$this->{$this->getPrimaryKey()}}"]);
    }
}