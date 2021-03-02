<?php

class Controller_PaymentMethod extends Controller_Core_Base {
    public function __construct() {
        parent::__construct();
        $this->setMessageService(new Model_Admin_Message);
    }

    public function gridAction() {
        try {
            $layout = $this->getLayout();
            $layout->prepareChildren(Block_Core_Layout::LAYOUT_ONE_COLUMN);
            $layout->getHeader()->addChild(new Block_Header);
            $layout->getContent()->addChild(new Block_PaymentMethod_Grid);
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
            $layout->getLeft()->addChild(new Block_PaymentMethod_Form_Tabs);
            $layout->getContent()->addChild(new Block_PaymentMethod_Form);
            $layout->getFooter()->addChild(new Block_Footer);

            echo $layout->render();
        } catch (Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
            Model_Core_UrlManager::redirect('grid', null, null, true);
        }
    }

    public function editAction() {
        try {
            $id = $this->getRequest()->getGet((new Model_PaymentMethod)->getPrimaryKey());
            if (!$id) {
                throw new Exception('Invalid Action. Id not found.');
            }
            $layout = $this->getLayout();
            $layout->prepareChildren(Block_Core_Layout::LAYOUT_TWO_COLUMNS_WITH_LEFT_SIDEBAR);
            $layout->getHeader()->addChild(new Block_Header);
            $layout->getLeft()->addChild(new Block_PaymentMethod_Form_Tabs);
            $layout->getContent()->addChild(new Block_PaymentMethod_Form((int)$id));
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
                throw new Exception("Invalid Request");
            }
            $paymentMethod = new Model_PaymentMethod();
            $id = $req->getGet($paymentMethod->getPrimaryKey());

            if ($id) {
                $paymentMethod->{$paymentMethod->getPrimaryKey()} = $id;
            }

            $paymentMethod->setData($req->getPost('paymentMethod'));
            $paymentMethod->status = $paymentMethod->status ? Model_PaymentMethod::STATUS_ENABLED : Model_PaymentMethod::STATUS_DISABLED;
            $result = $paymentMethod->save();
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
            $paymentMethod = new Model_PaymentMethod();

            $id = $this->getRequest()->getGet($paymentMethod->getPrimaryKey());
            if (!$id) {
                throw new Exception('Invalid Action. Id not found.');
            }
            if (!$paymentMethod->load($id)) {
                throw new Exception('Could not load data.');
            }
            if (!$paymentMethod->delete()) {
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
            $paymentMethod = new Model_PaymentMethod();

            $id = $this->getRequest()->getGet($paymentMethod->getPrimaryKey());
            if (!$id) {
                throw new Exception('Invalid Action. Could not find ID.');
            }
            if (!$paymentMethod->load($id)) {
                throw new Exception('Could not load data.');
            }
            $result = $paymentMethod->setData(['status' => (1 - $paymentMethod->status)])->save();
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