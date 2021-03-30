<?php
namespace Block\Admin\Cart\View;

use Mage;
use Model\Core\UrlManager;

class Grid extends \Block\Core\Template {
    public function __construct() {
        parent::__construct();
        $this->setTemplate('/admin/cart/view/grid.php');

        $cart = \Mage::getRegistry('current_cart');
        if ($cart) {
            $this->cartItems = \Mage::getModel('cart_item')->loadAll(["`cartId` = {$cart->getId()}"]);
            Mage::setRegistry('current_cart_items', $this->cartItems);
        }        
    }
}