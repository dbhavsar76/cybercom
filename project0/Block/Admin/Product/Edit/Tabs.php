<?php
namespace Block\Admin\Product\Edit;

class Tabs extends \Block\Core\Tabs {
    protected static $defaultTab = 'information';

    public function __construct($addMode = false) {
        $tabs = [
            ['name' => 'information'],
            ['name' => 'group price', 'hideOnAdd' => true],
            ['name' => 'media', 'url' => \Model\Core\UrlManager::getUrl('grid', 'product_media'), 'hideOnAdd' => true],
        ];
        parent::__construct($tabs, self::VERTICAL, $addMode);
    }
}