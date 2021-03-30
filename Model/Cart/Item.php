<?php
namespace Model\Cart;

class Item extends \Model\Core\Table {
    protected $product = null;

    public function __construct() {
        parent::__construct();
        $this->setTableName('cart_item');
        $this->setPrimaryKey('cartItemId');
    }

    public function getProduct() {
        if ($this->product) {
            return $this->product;
        }
        if ($this->getId()) {
            $this->product = \Mage::getModel('product');
            $this->product->load($this->productId);
        }
        return $this->product;
    }

    public function save() {
        $this->calculate();
        return parent::save();
    }

    private function calculate() {
        $this->price = $this->basePrice * $this->quantity * (1 - ($this->discount / 100));
        return $this;
    }

    public function getThumb() {
        // return $this->getProduct()->getThumb();
        $url = BASE_URL."/media/product/2/19.png";
        return "<img src=\"{$url}\" height=\"70\" width=\"70\">";
    }

    public function getName() {
        return $this->getProduct()->name;
    }
}