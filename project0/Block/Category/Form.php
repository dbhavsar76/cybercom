<?php

class Block_Category_Form extends Block_Core_Template {
    public function __construct(int $id = null) {
        $this->setTemplate('/category/addEditForm.php');

        $category = new Model_Category();
        if ($id) {
            $category->load($id);
            $this->formMode = 'Edit';
            $this->formAction = Model_Core_UrlManager::getUrl('save');
            $this->statusState = $category->status == Model_Category::STATUS_DISABLED ? '' : 'checked';
        } else {
            $this->formMode = 'Add';
            $this->formAction = Model_Core_UrlManager::getUrl('save', null, null, true);
            $this->statusState = 'checked';
        }
        $this->category = $category;
    }
}