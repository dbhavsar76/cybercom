<?php

class Controller_Dashboard extends Controller_Core_Base {
    public function __construct() {
        parent::__construct();
        $this->setMessageService(new Model_Admin_Message);
    }

    public function dashboardAction() {
        try {
            $layout = $this->getLayout();
            $layout->prepareChildren(Block_Core_Layout::LAYOUT_ONE_COLUMN);
            $layout->getChild('header')->addChild(new Block_Header);
            $layout->getChild('content')->addChild(new Block_Dashboard_Dashboard);
            $layout->getChild('footer')->addChild(new Block_Footer);

            echo $layout->render();
        } catch (Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
            Model_Core_UrlManager::redirect('dashboard', null, null, true);
        }
    }
}