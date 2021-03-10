<?php
namespace Block\Admin\Category\Edit;

class Tabs extends \Block\Core\Tabs {
    protected static $defaultTab = 'information';

    public function __construct() {
        $tabs = [
            ['name' => 'information'],
        ];
        parent::__construct($tabs, self::VERTICAL);
    }
}