<?php

class Block_CustomerGroup_Form_Tabs extends Block_Core_Tabs {
    protected static $defaultTab = 'information';

    public function __construct() {
        $tabs = [
            ['name' => 'information']
        ];
        parent::__construct($tabs, self::VERTICAL);
    }
}