<?php
namespace Block\Admin\Category\Edit\Tab;

class Information extends \Block\Core\Template {
    public function __construct($id = null) {
        parent::__construct();
        $this->setTemplate('/admin/category/edit/tab/information.php');

        $category = new \Model\Category();
        if ($id && !$category->load($id)) {
            throw new \Exception('Id not found.');
        }

        $this->category = $category;
        $this->statusState = $category->status == \Model\Category::STATUS_DISABLED ? '' : 'checked';
        $this->categoryOptions = $category->loadAll($id ? ["`path` NOT LIKE '{$category->path}%'"] : null, ['`path` ASC']);
    }
}