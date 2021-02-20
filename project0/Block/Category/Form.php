<?php
require_once ROOT.'\\Block\\Core\\Base.php';
require_once ROOT.'\\Model\\Category.php';

class Block_Category_Form extends Block_Core_Base {
    public function __construct(Controller_Core_Base $controller, int $id = null) {
        $this->setTemplate(ROOT.'\\View\\Category\\addEditForm.php');
        $this->setController($controller);

        $category = new Model_Category();
        if ($id) {
            $category->load($id);
            $this->formMode = 'Edit';
            $this->formAction = $this->getUrl('save');
            $this->statusState = $category->status == Model_Category::STATUS_DISABLED ? '' : 'checked';
        } else {
            $this->formMode = 'Add';
            $this->formAction = $this->getUrl('save', null, null, true);
            $this->statusState = 'checked';
        }
        $this->category = $category;
    }
}