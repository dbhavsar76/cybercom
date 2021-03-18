<?php
namespace Block\Admin\Entity\Attribute\Edit;

use Model\Core\UrlManager;

class Tabs extends \Block\Core\Edit\Tabs {
    protected static $defaultTab = 'information';

    public function __construct($addMode = false) {
        $tabs = [
            ['name' => 'information'],
            ['name' => 'options', 'url' => UrlManager::getUrl('grid', 'admin_entity_attribute_option'), 'hideOnAdd' => true]
        ];
        parent::__construct($tabs, self::VERTICAL, $addMode);
    }
}