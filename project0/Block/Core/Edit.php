<?php
namespace Block\Core;

class Edit extends Template {
    public function __construct($id = null) {
        $this->setTemplate('/core/edit.php');
        if ($id) {
            $this->formMode = 'Edit';
            $this->formAction = \Model\Core\UrlManager::getUrl('save');
        } else {
            $this->formMode = 'Add';
            $this->formAction = \Model\Core\UrlManager::getUrl('save', null, null, true);
        }

        $tabName = $this->prepareTabName();
        $this->addChild(new $tabName($id), 'tab');
    }

    private function prepareTabName() {
        $request = new \Model\Core\Request();
        
        $controllerName = $request->getGet('c');
        $controllerName = str_replace('_', ' ', $controllerName);
        $controllerName = str_replace('\\', ' ', $controllerName);
        $controllerName = str_replace(' ', '\\', ucwords($controllerName));
        
        $tabsClass = '\\Block\\'.$controllerName.'\\Edit\\Tabs';
        $tabName = ucfirst($request->getGet('tab', $tabsClass::getDefaultTab()));
        return '\\Block\\' . $controllerName . '\\Edit\\Tab\\' . $tabName;
    }
}