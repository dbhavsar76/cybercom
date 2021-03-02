<?php

class Block_Customer_Form_Tabs extends Block_Core_Tabs {
    protected static $defaultTab = 'information';

    public function __construct() {
        $tabs = [
            'information',
            'address'
        ];
        parent::__construct($tabs, self::VERTICAL);
    }
}