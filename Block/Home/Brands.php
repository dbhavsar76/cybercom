<?php
namespace Block\Home;

class Brands extends \Block\Core\Template {

    public function __construct() {
        parent::__construct();
        $this->setTemplate('/home/brands.php');

        $this->prepareCollection();
    }

    public function prepareCollection() {
        $collection = (new \Model\Brand)->loadAll(["`status` = 'enabled'"]);
        $this->collection = $collection;
        return $this;
    }
    
}