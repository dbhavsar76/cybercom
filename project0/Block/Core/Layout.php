<?php

class Block_Core_Layout extends Block_Core_Template {
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
                $this->addChild(new Block_Core_Layout_Header, 'header');
                $this->addChild(new Block_Core_Layout_Content, 'content');
                $this->addChild(new Block_Core_Layout_Footer, 'footer');
                break;

            case self::LAYOUT_TWO_COLUMNS_WITH_LEFT_SIDEBAR:
                $this->setTemplate('/core/layout/two_columns_with_left_sidebar.php');
                $this->addChild(new Block_Core_Layout_Header, 'header');
                $this->addChild(new Block_Core_Layout_Left, 'left');
                $this->addChild(new Block_Core_Layout_Content, 'content');
                $this->addChild(new Block_Core_Layout_Footer, 'footer');
                break;

            case self::LAYOUT_THREE_COLUMN:
                $this->setTemplate('/core/layout/three_column.php');
                $this->addChild(new Block_Core_Layout_Header, 'header');
                $this->addChild(new Block_Core_Layout_Left, 'left');
                $this->addChild(new Block_Core_Layout_Content, 'content');
                $this->addChild(new Block_Core_Layout_Right, 'right');
                $this->addChild(new Block_Core_Layout_Footer, 'footer');
                break;
 
            case self::LAYOUT_EMPTY:
            default:
                $this->setTemplate('/core/layout/empty.php');
                $this->addChild(new Block_Core_Layout_Content, 'content');
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