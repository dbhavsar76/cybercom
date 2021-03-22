<?php
namespace Block\Admin\Brand\Edit;

class Tabs extends \Block\Core\Edit\Tabs {
    protected static $defaultTab = 'information';

    public function __construct($addMode = false) {
        $tabs = [
            ['name' => 'information'],
        ];
        parent::__construct($tabs, self::VERTICAL, $addMode);
    }
}