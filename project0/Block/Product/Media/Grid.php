<?php

class Block_Product_Media_Grid extends Block_Core_Template {
    public function __construct() {
        parent::__construct();
        $this->setTemplate('/product/media/grid.php');

        $id = (new Model_Core_Request)->getGet((new Model_Product)->getPrimaryKey());
        $this->images = glob('media/product/'.$id.'/*.*');
    }
}