<?php

class Block_PaymentMethod_Form_Tabs extends Block_Core_Tabs {
    protected static $defaultTab = 'information';

    public function __construct() {
        $tabs = [
            'information',
            'dummy'
        ];
        parent::__construct($tabs, self::VERTICAL);
    }
}