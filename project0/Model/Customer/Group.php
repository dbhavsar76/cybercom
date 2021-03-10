<?php
namespace Model\Customer;

class Group extends \Model\Core\Table {
    public const DEFAULT = 1;
    public const NOT_DEFAULT = 0;

    public function __construct() {
        parent::__construct();
        $this->setTableName('customer_group');
        $this->setPrimaryKey('groupId');
    }

    public function makeDefault() {
        $id = $this->{$this->getPrimaryKey()};
        if (!$id) {
            return false;
        }
        $sql = "UPDATE `{$this->getTableName()}` SET `default` = IF(`{$this->getPrimaryKey()}`='{$id}', 1, 0)";
        return $this->adapter->update($sql);
    }
}