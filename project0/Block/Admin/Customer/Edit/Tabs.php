<?php
namespace Block\Admin\Customer\Edit;

class Tabs extends \Block\Core\Tabs {
    protected static $defaultTab = 'information';

    public function __construct() {
        $tabs = [
            ['name' => 'information'],
            ['name' => 'address']
        ];
        parent::__construct($tabs, self::VERTICAL);
    }
}