<?php

class Controller_ShippingMethod extends Controller_Core_Base {
    public function __construct() {
        parent::__construct();
        $this->setMessageService(new Model_Admin_Message);
    }

    public function gridAction() {
        try {
            $layout = $this->getLayout();
            $layout->prepareChildren(Block_Core_Layout::LAYOUT_ONE_COLUMN);
            $layout->getHeader()->addChild(new Block_Header);
            $layout->getContent()->addChild(new Block_ShippingMethod_Grid);
            $layout->getFooter()->addChild(new Block_Footer);

            echo $layout->render();
        } catch (Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
            Model_Core_UrlManager::redirect('grid', null, null, true);
        }
    }

    public function addAction() {
        try {
            $layout = $this->getLayout();
            $layout->prepareChildren(Block_Core_Layout::LAYOUT_TWO_COLUMNS_WITH_LEFT_SIDEBAR);
            $layout->getHeader()->addChild(new Block_Header);
            $layout->getLeft()->addChild(new Block_ShippingMethod_Form_Tabs);
            $layout->getContent()->addChild(new Block_ShippingMethod_Form);
            $layout->getFooter()->addChild(new Block_Footer);

            echo $layout->render();
        } catch (Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
            Model_Core_UrlManager::redirect('grid', null, null, true);
        }
    }

    public function editAction() {
        try {
            $id = $this->getRequest()->getGet((new Model_ShippingMethod)->getPrimaryKey());
            if (!$id) {
                throw new Exception('Invalid Request.');
            }

            $layout = $this->getLayout();
            $layout->prepareChildren(Block_Core_Layout::LAYOUT_TWO_COLUMNS_WITH_LEFT_SIDEBAR);
            $layout->getHeader()->addChild(new Block_Header);
            $layout->getLeft()->addChild(new Block_ShippingMethod_Form_Tabs);
            $layout->getContent()->addChild(new Block_ShippingMethod_Form((int)$id));
            $layout->getFooter()->addChild(new Block_Footer);

            echo $layout->render();
        } catch (Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
            Model_Core_UrlManager::redirect('grid', null, null, true);
        }
    }

    public function saveAction() {
        try {
            $req = $this->getRequest();
            if (!$req->isPost() || empty($_SERVER['HTTP_REFERER'])) {
                throw new Exception('Invalid Request.');
            }
            $shippingMethod = new Model_ShippingMethod();
            $id = $req->getGet($shippingMethod->getPrimaryKey());

            if ($id) {
                $shippingMethod->{$shippingMethod->getPrimaryKey()} = $id;
            }

            $shippingMethod->setData($req->getPost('shippingMethod', []));
            $shippingMethod->status = $shippingMethod->status ? Model_ShippingMethod::STATUS_ENABLED : Model_ShippingMethod::STATUS_DISABLED;
            $result = $shippingMethod->save();
            if (!$result) {
                throw new Exception('Something went wrong. Could not save data.');
            }
            $this->getMessageService()->setSuccess('Record saved successfully.');
            Model_Core_UrlManager::redirect('grid', null, null, true);
        } catch (Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
            Model_Core_UrlManager::redirect(-1);
        }
    }
    
    public function deleteAction() {
        try {
            $shippingMethod = new Model_ShippingMethod();

            $id = $this->getRequest()->getGet($shippingMethod->getPrimaryKey());
            if (!$id) {
                throw new Exception('Invalid Action. Id not found.');
            }
            if (!$shippingMethod->load($id)) {
                throw new Exception('Could not load data.');
            }
            if (!$shippingMethod->delete()) {
                throw new Exception('Could not delete record.');
            }
            $this->getMessageService()->setSuccess('Record deleted successfully.');
        } catch (Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
        } finally {
            Model_Core_UrlManager::redirect('grid', null, null, true);
        }
    }

    public function toggleStatusAction() {
        try {
            $shippingMethod = new Model_ShippingMethod();

            $id = $this->getRequest()->getGet($shippingMethod->getPrimaryKey());
            if (!$id) {
                throw new Exception('Invalid Action. Could not find ID.');
            }
            if (!$shippingMethod->load($id)) {
                throw new Exception('Could not load data.');
            }
            $result = $shippingMethod->setData(['status' => (1 - $shippingMethod->status)])->save();
            if (!$result) {
                throw new Exception('Something went wrong. Could not save data.');
            }
            $this->getMessageService()->setSuccess('Status changed successfully.');
        } catch (Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
        } finally {
           Model_Core_UrlManager::redirect('grid', null, null, true);
        }
    }
}