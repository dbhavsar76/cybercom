<?php

class Block_Product_Form_Tabs extends Block_Core_Tabs {
    protected static $defaultTab = 'information';

    public function __construct() {
        $tabs = [
            'information',
            'media'
        ];
        parent::__construct($tabs, self::VERTICAL);
    }
}