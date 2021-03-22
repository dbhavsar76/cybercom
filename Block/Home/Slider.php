<?php
namespace Block\Home;

use Block\Core\Template;
use Model\Product;

class Slider extends Template {
    public function __construct() {
        parent::__construct();
        $this->setTemplate('/home/slider.php');
    }

    public function prepareDeals() {
        $this->title = 'Best Deals';
        $this->products = (new Product)->loadAll(["`deal` = 'yes'"], null, "8");
        return $this;
    }

    public function preparePopular() {
        $this->title = 'Popular Items';
        $this->products = (new Product)->loadAll(["`popular` = 'yes'"], null, "8");
        return $this;
    }
}