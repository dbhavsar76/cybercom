<?php
namespace Model;

class Customer extends \Model\Core\Table {
    public const STATUS_ENABLED = 'enabled';
    public const STATUS_DISABLED = 'disabled';

    public function __construct() {
        parent::__construct();
        $this->setTableName('customer');
        $this->setPrimaryKey('id');
    }

    public function load($id = null, $conditions = null) {
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
                LEFT JOIN `customer_group` `cg` ON `c`.`groupId` = `cg`.`groupId`
                LEFT JOIN `customer_address` `ca` ON `c`.`id` = `ca`.`customerId`
                GROUP BY `c`.`id` HAVING `c`.`id` = {$id}";
        $result = $this->fetchRow($sql);
        if (!$result) {
            return false;
        }
        $this->setData($result);
        return $this;
    }

    public function loadAll($conditions = null, $orderBy = null, $limit = null) {
        $sql = "SELECT `c`.*, `cg`.`name` `groupName`, GROUP_CONCAT(`ca`.`addressId`) `addressIds`, `ca`.`zipcode` `zipcode`
                FROM `customer` `c`
                LEFT JOIN `customer_group` `cg` ON `c`.`groupId` = `cg`.`groupId`
                LEFT JOIN `customer_address` `ca` ON `c`.`id` = `ca`.`customerId`
                GROUP BY `c`.`id`";
        if (!empty($conditions)) {
            $sql .= " WHERE " . implode(" AND ", $conditions);
        }
        if (!empty($orderBy)) {
            $sql .= " ORDER BY " . implode(', ', $orderBy);
        }
        if (!empty($limit)) {
            $sql .= " LIMIT {$limit}";
        }
        $result = $this->fetchAll($sql);
        if ($result === false) {
            return $result;
        }
        return  new \Model\Collection\Customer($result);
    }

}