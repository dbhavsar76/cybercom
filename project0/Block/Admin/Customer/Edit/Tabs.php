<?php
namespace Block\Admin\Customer\Edit;

class Tabs extends \Block\Core\Edit\Tabs {
    protected static $defaultTab = 'information';

    public function __construct($addMode = false) {
        $tabs = [
            ['name' => 'information'],
            ['name' => 'address', 'hideOnAdd' => true]
        ];
        parent::__construct($tabs, self::VERTICAL, $addMode);
    }
}