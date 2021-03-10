<?php
namespace Block\Core;

class Tabs extends Template {
    public const HORIZONTAL = 'flex-row';
    public const VERTICAL = 'flex-column';

    protected $tabs = [];
    protected static $defaultTab = null;
    protected $alignment = self::HORIZONTAL;

    public function __construct(array $tabs = [], $alignment = self::HORIZONTAL, $addMode = false) {
        $this->tabs = $tabs;
        $this->alignment = $alignment;
        $this->setTemplate('/core/tabs.php');
        $this->addMode = $addMode;
    }

    public function setTabs(array $tabs) {
        $this->tabs = $tabs;
        return $this;
    }

    public function getTabs($all = false) {
        if ($all) {
            return $this->tabs;
        }
        $effectiveTabs = [];
        foreach ($this->tabs as $tab) {
            if (!empty($tab['hideOnAdd']) && $tab['hideOnAdd'] && $this->addMode) {
                continue;
            }
            $effectiveTabs[] = $tab;
        }
        return $effectiveTabs;
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

    public function prepareName($name) {
        return str_replace(' ', '', ucwords($name));
    }
}