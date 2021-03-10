<?php
namespace Controller\Admin;

class Dashboard extends \Controller\Core\Base {
    public function __construct() {
        parent::__construct();
        $this->setMessageService(new \Model\Admin\Message);
    }

    public function indexAction() {
        try {
            $layout = $this->getLayout();
            $layout->prepareChildren(\Block\Core\Layout::LAYOUT_THREE_COLUMN);
            $layout->getHeader()->addChild(new \Block\Admin\Header);
            $layout->getFooter()->addChild(new \Block\Admin\Footer);
            echo $layout->render();
        } catch (\Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
            \Model\Core\UrlManager::redirect('dashboard', null, null, true);
        }        
    }

    public function dashboardAction() {
        try {
            $response = [
                'status' => 'success',
                'message' => '',
                'layout' => \Block\Core\Layout::LAYOUT_ONE_COLUMN,
                'element' => [
                    [
                        'selector' => '#content',
                        'html' => (new \Block\Admin\Dashboard\Dashboard)->render()
                    ],
                ]
            ];
            header("Content-type: application/json; charset=utf-8");
            echo json_encode($response);
        } catch (\Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
            \Model\Core\UrlManager::redirect('dashboard', null, null, true);
        }
    }
}