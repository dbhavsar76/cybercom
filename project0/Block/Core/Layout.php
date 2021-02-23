<?php

class Block_Core_Layout extends Block_Core_Template {
    public const LAYOUT_EMPTY = 0;
    public const LAYOUT_ONE_COLUMN = 1;
    public const LAYOUT_TWO_COLUMNS_WITH_LEFT_SIDEBAR = 2;
    public const LAYOUT_THREE_COLUMN = 3;

    public function __construct() {}

    public function prepareChildren($type) {
        switch ($type) {
            case self::LAYOUT_EMPTY:
                $this->setTemplate('/core/layout/empty.php');
                $this->addChild(new Block_Core_Layout_Content, 'content');
                break;

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
        }
    }
}