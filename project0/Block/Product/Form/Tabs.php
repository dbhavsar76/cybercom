<?php

class Block_Product_Form_Tabs extends Block_Core_Tabs {
    protected static $defaultTab = 'information';

    public function __construct() {
        $tabs = [
            ['name' => 'information'],
            ['name' => 'media', 'url' => Model_Core_UrlManager::getUrl('grid', 'product_media')]
        ];
        parent::__construct($tabs, self::VERTICAL);
    }
}