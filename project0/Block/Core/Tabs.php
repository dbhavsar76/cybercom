<?php

class Block_Core_Tabs extends Block_Core_Template {
    public const HORIZONTAL = 'flex-row';
    public const VERTICAL = 'flex-column';

    protected $tabs = [];
    protected static $defaultTab = null;
    protected $alignment = self::HORIZONTAL;

    public function __construct(array $tabs = [], $alignment = self::HORIZONTAL) {
        $this->tabs = $tabs;
        $this->alignment = $alignment;
        $this->setTemplate('/core/tabs.php');
    }

    public function setTabs(array $tabs) {
        $this->tabs = $tabs;
        return $this;
    }

    public function getTabs() {
        return $this->tabs;
    }

    public function setAlignment($alignment) {
        $this->alignment = $alignment;
        return $this;
    }

    public function getAlignment() {
        return $this->alignment;
    }

    public static function setDefaultTab($tab) {
        static::$defaultTab = $tab;
    }

    public static function getDefaultTab() {
        return static::$defaultTab;
    }

}