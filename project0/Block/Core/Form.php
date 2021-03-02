<?php

class Block_Core_Form extends Block_Core_Template {
    public function __construct(int $id = null) {
        if ($id) {
            $this->formMode = 'Edit';
            $this->formAction = Model_Core_UrlManager::getUrl('save');
        } else {
            $this->formMode = 'Add';
            $this->formAction = Model_Core_UrlManager::getUrl('save', null, null, true);
        }

        $request = new Model_Core_Request();
        $controllerName = ucfirst($request->getGet('c'));
        $tabsClass = 'Block_'.$controllerName.'_Form_Tabs';
        $tabName = ucfirst($request->getGet('tab', $tabsClass::getDefaultTab()));
        $tabName = 'Block_' . $controllerName . '_Form_Tab_' . $tabName;
        $this->addChild(new $tabName($id), 'tab');
    }
}