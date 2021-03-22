<?php
namespace Model;

class Category extends \Model\Core\Table {
    public const STATUS_ENABLED = 'enabled';
    public const STATUS_DISABLED = 'disabled';
    
    protected static $mapping = null;
    
    public function __construct() {
        parent::__construct();
        $this->setTableName('category');
        $this->setPrimaryKey('id');
    }

    public function setMapping() {
        $mapping = [];
        $sql = "SELECT `id`, `name` FROM `category`";
        $categories = $this->fetchAll($sql);
        foreach ($categories as $category) {
            $mapping[$category['id']] = $category['name'];
        }
        static::$mapping = $mapping;
    }

    public function getMapping() {
        if (!static::$mapping) {
            $this->setMapping();
        }
        return static::$mapping;
    }

    public function delete() {
        $primaryKey = $this->getPrimaryKey();
        $parent = new Category;
        $parent->load($this->parentId);
        $children = $this->loadAll(["`parentId` = {$this->$primaryKey}"]);
        foreach($children as $child) {
            $child->parentId = $parent->$primaryKey;
            $child->updatePath($parent);
        }
        return parent::delete();
    }

    public function getFullName() {
        $path = explode(',', $this->path);
        foreach ($path as $key => $id) {
            $path[$key] = $this->getMapping()[$id];
        }
        return implode(' => ', $path);
    }

    public function updatePath($parent) {
        $this->path = trim($parent->path.','.$this->id, ',');
        $children = $this->loadAll(["`parentId` = {$this->id}"]);
        $updated = 1;
        foreach ($children as $child) {
            $updated &= $child->updatePath($this);
        }
        return $this->save() && $updated;
    }
}