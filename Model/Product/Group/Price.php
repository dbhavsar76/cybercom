<?php

namespace Model\Product\Group;

class Price extends \Model\Core\Table {
    public function __construct() {
        parent::__construct();
        $this->setTableName('product_group_price');
        $this->setPrimaryKey('entityId');
    }

    public function loadAll($conditions = null, $orderBy = null, $limit = null)
    {
        if (empty($conditions) || empty($conditions['productId'])) {
            $productId = 0;
        } else {
            $productId = $conditions['productId'];
        }
        $sql = "SELECT cg.`groupId`, cg.`name`, pgp.`entityId`, pgp.`price`
                FROM `customer_group` cg
                LEFT JOIN `product_group_price` pgp
                ON pgp.`productId` = {$productId} AND cg.`groupId` = pgp.`groupId`";
        $result = $this->getAdapter()->fetchAll($sql);
        if ($result === false) {
            return $result;
        }

        return new \Model\Collection\Product\Group\Price($result);
    }

    public function insertMultiple($productId, $groupPriceData = []) {
        if (empty($groupPriceData)) {
            return true;
        }
        $values = [];
        foreach($groupPriceData as $groupId => $price) {
            $values[] = "({$groupId}, {$productId}, {$price})";
        }
        $sql = "INSERT INTO `{$this->getTableName()}`(`groupId`, `productId`, `price`) VALUES " . implode(',', $values);
        return $this->getAdapter()->insert($sql);
    }
}