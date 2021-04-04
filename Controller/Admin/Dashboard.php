<?php
namespace Controller\Admin;

class Dashboard extends \Controller\Core\Admin {

    public function indexAction() {
        try {
            $layout = $this->getLayout();
            $layout->prepareChildren(\Block\Admin\Layout::LAYOUT_THREE_COLUMN);
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
            $dashboardHtml = (new \Block\Admin\Dashboard\Dashboard)->render();
            $response = $this->getResponse();
            $response->setStatus('success');
            $response->setLayout(\Block\Core\Layout::LAYOUT_ONE_COLUMN);
            $response->addElement('#content', $dashboardHtml);
            $response->send();
        } catch (\Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
            \Model\Core\UrlManager::redirect('dashboard', null, null, true);
        }
    }

    public function testAction() {
        echo '<pre>';
        $model = \Mage::getModel('admin');
        $model->name = 'admin';
        print_r($model);
        $model->load(1);
        print_r($model);
        $model->save();
    }
}