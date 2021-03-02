<?php

class Block_Admin_Form_Tabs extends Block_Core_Tabs {
    protected static $defaultTab = 'information';

    public function __construct() {
        $tabs = [
            'information',
            'permission'
        ];
        parent::__construct($tabs, self::VERTICAL);
    }
}