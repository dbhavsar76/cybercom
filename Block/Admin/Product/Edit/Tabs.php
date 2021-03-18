<?php
namespace Block\Admin\Product\Edit;

class Tabs extends \Block\Core\Edit\Tabs {
    protected static $defaultTab = 'information';

    public function __construct($addMode = false) {
        $tabs = [
            ['name' => 'information'],
            ['name' => 'group price', 'hideOnAdd' => true],
            ['name' => 'category', 'hideOnAdd' => true],
            ['name' => 'attributes', 'hideOnAdd' => true],
            ['name' => 'media', 'url' => \Model\Core\UrlManager::getUrl('grid', 'admin_product_media'), 'hideOnAdd' => true],
        ];
        parent::__construct($tabs, self::VERTICAL, $addMode);
    }
}