<?php
namespace Model;

use Model\Product\Media;

class Product extends \Model\Core\Table {
    public const STATUS_ENABLED = 'enabled';
    public const STATUS_DISABLED = 'disabled';

    public function __construct() {
        parent::__construct();
        $this->setTableName('product');
        $this->setPrimaryKey('id');
    }

    public function getCategories() {
        $sql = "SELECT c.*, pc.`productId` FROM `category` c LEFT JOIN `product_category` pc ON c.`id` = pc.`categoryId` WHERE `productId`={$this->id} OR `productId` IS NULL ORDER BY c.`path` ASC";
        $result = $this->fetchAll($sql);
        if (!$result) {
            return $result;
        }

        return new \Model\Collection\Category($result);
    }

    public function updateCategories($categories = []) {
        $pk = $this->getPrimaryKey();
        $sql = "DELETE FROM `product_category` WHERE `productId` = {$this->$pk}";
        $result = $this->getAdapter()->delete($sql);
        if ($result === false || count($categories) === 0) {
            return $result;
        }

        $sql = "INSERT INTO `product_category`(`productId`, `categoryId`) VALUES ";
        $values = [];
        foreach ($categories as $categoryId) {
            $values[] = "({$this->$pk}, {$categoryId})";
        }
        $sql .= implode(', ', $values);
        return $this->getAdapter()->insert($sql);
    }

    public function getAttributes() {
        $entityType = (new \Model\Entity\Type)->load(null, ["`tableName` = '{$this->getTableName()}'"]);
        $attributes = (new \Model\Entity\Attribute)->loadAll(["`entityTypeId` = {$entityType->{$entityType->getPrimaryKey()}}"]);
        return $attributes;
    }

    public function saveAttributes($attributesData) {
        foreach ($attributesData as $key => $value) {
            if (is_array($value)) {
                $attributesData[$key] = implode(',', $value);
            }
        }
        $this->setData($attributesData);
        return $this->save();
    }

    public function getBase() {
        $pk = $this->getPrimaryKey();
        if ($this->$pk) {
            return "#";
        }

        $media = (new Media)->load(null, ["`productId` = {$this->$pk}", "`base` = 1"]);
        if (!$media) {
            return "#";
        }
        return $media->getUrl();
    }

    public function getSmall() {
        $pk = $this->getPrimaryKey();
        if ($this->$pk) {
            return "#";
        }

        $media = (new Media)->load(null, ["`productId` = {$this->$pk}", "`small` = 1"]);
        if (!$media) {
            return "#";
        }
        return $media->getUrl();
    }

    public function getThumb() {
        $pk = $this->getPrimaryKey();
        if ($this->$pk) {
            return "#";
        }

        $media = (new Media)->load(null, ["`productId` = {$this->$pk}", "`thumb` = 1"]);
        if (!$media) {
            return "#";
        }
        return $media->getUrl();
    }

    public function getGallery() {
        $pk = $this->getPrimaryKey();
        if ($this->$pk) {
            return "#";
        }

        $gallery = [];
        $media = (new Media)->loadAll(["`productId` = {$this->$pk}", "`gallery` = 1"]);
        foreach ($media as $image) {
            $gallery[] = $image->getUrl();
        }
        return $gallery;
    }
}