<?php

class Controller_Dashboard extends Controller_Core_Base {
    public function __construct() {
        parent::__construct();
        $this->setMessageService(new Model_Admin_Message);
    }

    public function indexAction() {
        try {
            $layout = $this->getLayout();
            $layout->prepareChildren(Block_Core_Layout::LAYOUT_THREE_COLUMN);
            $layout->getHeader()->addChild(new Block_Header);
            $layout->getFooter()->addChild(new Block_Footer);
            echo $layout->render();
        } catch (Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
            Model_Core_UrlManager::redirect('dashboard', null, null, true);
        }        
    }

    public function dashboardAction() {
        try {
            $response = [
                'status' => 'success',
                'message' => '',
                'layout' => Block_Core_Layout::LAYOUT_ONE_COLUMN,
                'element' => [
                    [
                        'selector' => '#content',
                        'html' => (new Block_Dashboard_Dashboard)->render()
                    ],
                ]
            ];
            header("Content-type: application/json; charset=utf-8");
            echo json_encode($response);
        } catch (Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
            Model_Core_UrlManager::redirect('dashboard', null, null, true);
        }
    }
}