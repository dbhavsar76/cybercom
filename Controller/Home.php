<?php
namespace Controller;

class Home extends Core\Customer {

    public function indexAction() {
        try {
            $layout = $this->getLayout();
            $layout->prepareChildren(\Block\Layout::LAYOUT_THREE_COLUMN);
            $layout->getHeader()->addChild(new \Block\Header);
            $layout->getContent()->addChild(new \Block\Home);
            $layout->getFooter()->addChild(new \Block\Footer);
            echo $layout->render();
        } catch (\Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
        }
    }

    public function homeAction() {
        try {
            $homeBlock = \Mage::getBlock('home_home');
            $homeHtml = $homeBlock->render();
        } catch (\Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
        }
        $response = $this->getResponse();
        $response->setStatus('success');
        $response->setLayout(\Block\Layout::LAYOUT_ONE_COLUMN);
        $response->addElement('#content', $homeHtml);

        $message = $this->getMessageService()->getMessage();
        if ($message) {
            $messageHtml = \Mage::getBlock('core_message');
            $response->addElement('#message', $messageHtml);
            $this->getMessageService()->clearMessage();
        }

        $response->send();
    }
}