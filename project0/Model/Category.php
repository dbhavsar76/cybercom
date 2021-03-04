<?php

class Model_Category extends Model_Core_Table {
    public const STATUS_ENABLED = 1;
    public const STATUS_DISABLED = 0;
    protected $children = null;
    
    public function __construct() {
        parent::__construct();
        $this->setTableName('category');
        $this->setPrimaryKey('id');
    }

    public function loadAllTree($conditions = []) {
        $categories = $this->loadAll(array_merge(['`parentId` = 0'], $conditions));
        $this->loadAllTreeHelper($categories, $conditions);
        return $categories;
    }

    private function loadAllTreeHelper($categories, $conditions = []) {
        foreach ($categories as $category) {
            $category->setChildren($this->loadAll(array_merge(["`parentId` = {$category->{$this->getPrimaryKey()}}"], $conditions)));
            $this->loadAllTreeHelper($category->getChildren(), $conditions);
        }
    }

    public function delete() {
        $sql = "UPDATE `category` `A` LEFT JOIN `category` `B`
        ON `B`.`parentId` = `A`.`id`
        SET `B`.`parentId` = `A`.`parentId`
        WHERE `A`.`id` = {$this->id}";
        if (!$this->adapter->update($sql)) {
            return false;
        }
        return parent::delete();
    }

    public function setChildren($children) {
        $this->children = $children;
        return $this;
    }

    public function getChildren() {
        return $this->children;
    }
}