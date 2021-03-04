<?php

class Model_Customer extends Model_Core_Table {
    public const STATUS_ENABLED = 1;
    public const STATUS_DISABLED = 0;

    public function __construct() {
        parent::__construct();
        $this->setTableName('customer');
        $this->setPrimaryKey('id');
    }

    public function load($id = null) {
        if (!$id) {
            if ($this->id) {
                $id = $this->id;
            } else {
                return false;
            }
        }
        $id = (int)$id;
        $sql = "SELECT `c`.*, `cg`.`name` `groupName`, GROUP_CONCAT(`ca`.`addressId`) `addressIds`, `ca`.`zipcode` `zipcode`
                FROM `customer` `c`
                LEFT JOIN `customergroup` `cg` ON `c`.`groupId` = `cg`.`groupId`
                LEFT JOIN `customer_address` `ca` ON `c`.`id` = `ca`.`customerId`
                GROUP BY `c`.`id` HAVING `c`.`id` = {$id}";
        return $this->fetchRow($sql);
    }

    public function loadAll($conditions = null) {
        $sql = "SELECT `c`.*, `cg`.`name` `groupName`, GROUP_CONCAT(`ca`.`addressId`) `addressIds`, `ca`.`zipcode` `zipcode`
                FROM `customer` `c`
                LEFT JOIN `customergroup` `cg` ON `c`.`groupId` = `cg`.`groupId`
                LEFT JOIN `customer_address` `ca` ON `c`.`id` = `ca`.`customerId`
                GROUP BY `c`.`id`";
        if ($conditions) {
            $sql .= " WHERE " . implode(" AND ", $conditions);
        }
        return $this->fetchAll($sql);
    }

}