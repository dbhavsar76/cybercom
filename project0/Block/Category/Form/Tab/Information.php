<?php

class Block_Category_Form_Tab_Information extends Block_Core_Template {
    public function __construct(int $id = null) {
        parent::__construct();
        $this->setTemplate('/category/form/tab/information.php');

        $category = new Model_Category();
        $conditions = [];
        if ($id) {
            if (!$category->load($id)) {
                throw new Exception('Id not found.');
            }
            $conditions[] = "`{$category->getPrimaryKey()}` != {$id}";
        }

        $this->category = $category;
        $this->statusState = $category->status == Model_Category::STATUS_DISABLED ? '' : 'checked';
        $this->categoryOptions = $category->loadAllTree($conditions);
    }
}