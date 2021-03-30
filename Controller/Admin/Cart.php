<?php
namespace Controller\Admin;

use Block\Admin\Layout;
use Block\Core\Message;
use Exception;
use Mage;
use Model\Core\UrlManager;

class Cart extends \Controller\Core\Admin {

    public function viewAction() {
        try {
            $session = $this->getSession();
            if ($cc = $this->getRequest()->getGet('current_customer')) {
                $session->current_customer = $cc;
            }
            Mage::setRegistry('current_customer', $session->current_customer);

            $cart = $this->getCart();
            Mage::setRegistry('current_cart', $cart);

            $cartBlock = \Mage::getBlock('admin_cart_view');
            $cartHtml = $cartBlock->render();
        } catch (\Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
        }

        $response = $this->getResponse();
        $response->setStatus('success');
        $response->setLayout(Layout::LAYOUT_ONE_COLUMN);
        $response->addElement('#content', $cartHtml);

        $message = $this->getMessageService()->getMessage();
        if ($message) {
            $messageHtml = (new Message($message))->render();
            $response->addElement("#message", $messageHtml);
            $this->getMessageService()->clearMessage();
        }

        $response->send();
    }

    public function addProductAction() {
        $response = $this->getResponse();
        try {
            $productId = $this->getRequest()->getGet('productId');
            if (!$productId) {
                throw new Exception('Product not selected.');
            }

            $cart = $this->getCart();
            if (!$cart) {
                throw new Exception('Please select a customer first in cart.');
            }

            $cartItem = Mage::getModel('cart_item');
            if ($cartItem->load(null, ["`cartId` = {$cart->getId()}", "`productId` = {$productId}"])) {
                $cartItem->quantity = $cartItem->quantity + 1;
            } else {
                $product = Mage::getModel('product');
                $product->load($productId);
                $cartItem->cartId = $cart->getId();
                $cartItem->productId = $productId;
                $cartItem->basePrice = $product->price;
                $cartItem->discount = $product->discount;
                $cartItem->quantity = 1;
            }
            if (!$cartItem->save()) {
                throw new Exception('There was a problem adding product into the cart.');
            }

            $cart = $this->getCart();
            $cartItems = $cart->getItems();
            $total = 0;
            foreach ($cartItems as $item) {
                $total += $item->basePrice * $item->quantity * (1 - ($item->discount / 100));
            }
            $cart->total = $total;
            $cart->save();    

            $this->getMessageService()->setSuccess('Product added to cart.');
        } catch (\Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
        }

        $message = $this->getMessageService()->getMessage();
        if ($message) {
            $messageHtml = (new Message($message))->render();
            $response->addElement("#message", $messageHtml);
            $this->getMessageService()->clearMessage();
        }

        $response->send();
    }

    public function updateCartAction() {
        $cartItemsData = $this->getRequest()->getPost('cartItem');
        $cartItem = Mage::getModel('cart_item');
        foreach ($cartItemsData ?? [] as $itemId => $itemData) {
            $cartItem->load($itemId)->setData($itemData)->save();
        }

        $cartAddressData = $this->getRequest()->getPost('cartAddress');
        $billingAddressData = $cartAddressData['billing'];
        $billingAddress = Mage::getModel('cart_address');
        $billingAddress->setData($billingAddressData)->save();

        $shippingAddress = Mage::getModel('cart_address');
        if (!empty($cartAddressData['copyToShipping'])) {
            $billingAddressData[$billingAddress->getPrimaryKey()] = $cartAddressData['shipping'][$billingAddress->getPrimaryKey()];
            $billingAddressData['type'] = $billingAddress::TYPE_SHIPPING;
            $shippingAddress->setData($billingAddressData);
        } else {
            $shippingAddressData = $cartAddressData['shipping'];
            $shippingAddress->setData($shippingAddressData);
        }
        $shippingAddress->save();

        $cart = $this->getCart();
        $cartData = $this->getRequest()->getPost('cart', []);
        $cart->setData($cartData);
        $cartItems = $cart->getItems();
        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item->basePrice * $item->quantity * (1 - ($item->discount / 100));
        }
        $cart->total = $total;
        $cart->save();

        $this->getResponse()->setAjaxRedirect(UrlManager::getUrl('view'))->send();
    }

    private function getCart() {
        $session = $this->getSession();
        $cart = Mage::getModel('cart');
        $currentCustomer = $session->current_customer;
        if (!$currentCustomer) {
            return null;
        }
        if (!$cart->load(null, ["`customerId` = {$currentCustomer}"])) {
            $cartId = $cart->setData(['customerId' => $currentCustomer, 'sessionId' => $session->getId()])->save();
            if ($cartId !== false) {
                $cart->cartId = $cartId;
            }
        }
        return $cart;
    }
}