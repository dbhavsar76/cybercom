<?php
namespace Block\Core;

class Layout extends Template {
    public const LAYOUT_EMPTY = 'empty';
    public const LAYOUT_ONE_COLUMN = 'oneColumn';
    public const LAYOUT_TWO_COLUMNS_WITH_LEFT_SIDEBAR = 'twoColumnWithLeftSidebar';
    public const LAYOUT_THREE_COLUMN = 'threeColumn';

    public function __construct() {
        # empty
    }

    public function prepareChildren($type) {
        switch ($type) {
            case self::LAYOUT_ONE_COLUMN:
                $this->setTemplate('/core/layout/one_column.php');
                $this->addChild(new Layout\Header, 'header');
                $this->addChild(new Layout\Content, 'content');
                $this->addChild(new Layout\Footer, 'footer');
                break;

            case self::LAYOUT_TWO_COLUMNS_WITH_LEFT_SIDEBAR:
                $this->setTemplate('/core/layout/two_columns_with_left_sidebar.php');
                $this->addChild(new Layout\Header, 'header');
                $this->addChild(new Layout\Left, 'left');
                $this->addChild(new Layout\Content, 'content');
                $this->addChild(new Layout\Footer, 'footer');
                break;

            case self::LAYOUT_THREE_COLUMN:
                $this->addChild(new Layout\Header, 'header');
                $this->addChild(new Layout\Left, 'left');
                $this->addChild(new Layout\Content, 'content');
                $this->addChild(new Layout\Right, 'right');
                $this->addChild(new Layout\Footer, 'footer');
                break;
 
            case self::LAYOUT_EMPTY:
            default:
                $this->setTemplate('/core/layout/empty.php');
                $this->addChild(new Layout\Content, 'content');
                break;
    
        }
    }

    public function getHeader() {
        return $this->getChild('header');
    }

    public function getFooter() {
        return $this->getChild('footer');
    }

    public function getContent() {
        return $this->getChild('content');
    }

    public function getLeft() {
        return $this->getChild('left');
    }

    public function getRight() {
        return $this->getChild('right');
    }
}