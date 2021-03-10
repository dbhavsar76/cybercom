<?php
namespace Block\Core;

class Edit extends Template {
    public function __construct(int $id = null) {
        $this->setTemplate('/core/edit.php');
        if ($id) {
            $this->formMode = 'Edit';
            $this->formAction = \Model\Core\UrlManager::getUrl('save');
        } else {
            $this->formMode = 'Add';
            $this->formAction = \Model\Core\UrlManager::getUrl('save', null, null, true);
        }

        $request = new \Model\Core\Request();
        $controllerName = ucfirst($request->getGet('c'));
        $tabsClass = '\\Block\\Admin\\'.$controllerName.'\\Edit\\Tabs';
        $tabName = ucfirst($request->getGet('tab', $tabsClass::getDefaultTab()));
        $tabName = '\\Block\\Admin\\' . $controllerName . '\\Edit\\Tab\\' . $tabName;
        $this->addChild(new $tabName($id), 'tab');
    }
}