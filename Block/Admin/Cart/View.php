<?php
namespace Block\Admin\Cart;

use Mage;

class View extends \Block\Core\Template {
    public function __construct() {
        parent::__construct();
        $this->setTemplate('/admin/cart/view.php');

        $this->prepareChildren();

        $cartItems = Mage::getRegistry('current_cart_items');
        $baseTotal = $discountTotal = $effectiveTotal = 0;
        foreach ($cartItems ?? [] as $item) {
            $baseTotal += $item->basePrice * $item->quantity;
            $discountTotal += $item->basePrice * ($item->discount / 100) * $item->quantity;
            $effectiveTotal += $item->price;
        }
        $this->baseTotal = $baseTotal;
        $this->discountTotal = $discountTotal;
        $this->effectiveTotal = $effectiveTotal;
    }

    public function prepareChildren() {
        $customerSelectorBlock = Mage::getBlock('admin_cart_view_customerSelector');
        $this->addChild($customerSelectorBlock, 'customerSelector');
        
        $gridBlock = Mage::getBlock('admin_cart_view_grid');
        $this->addChild($gridBlock, 'cartGrid');
        
        $addressesBlock = Mage::getBlock('admin_cart_view_addresses');
        $this->addChild($addressesBlock, 'cartAddresses');
    }
}