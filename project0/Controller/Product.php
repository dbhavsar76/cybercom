<?php

class Controller_Product extends Controller_Core_Base {
    public function __construct() {
        parent::__construct();
        $this->setMessageService(new Model_Admin_Message);
    }

    public function gridAction() {
        try {
            $layout = $this->getLayout();
            $layout->prepareChildren(Block_Core_Layout::LAYOUT_ONE_COLUMN);
            $layout->getHeader()->addChild(new Block_Header);
            $layout->getContent()->addChild(new Block_Product_Grid);
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
            $layout->getLeft()->addChild(new Block_Product_Form_Tabs);
            $layout->getContent()->addChild(new Block_Product_Form);
            $layout->getChild('footer')->addChild(new Block_Footer);

            echo $layout->render();
        } catch (Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
            Model_Core_UrlManager::redirect('grid', null, null, true);
        }
    }

    public function editAction() {
        try {
            $id = $this->getRequest()->getGet((new Model_Product)->getPrimaryKey());
            if (!$id) {
                throw new Exception('Invalid Action.');
            }
            $layout = $this->getLayout();
            $layout->prepareChildren(Block_Core_Layout::LAYOUT_TWO_COLUMNS_WITH_LEFT_SIDEBAR);
            $layout->getHeader()->addChild(new Block_Header);
            $layout->getLeft()->addChild(new Block_Product_Form_Tabs);
            $layout->getContent()->addChild(new Block_Product_Form((int)$id));
            $layout->getChild('footer')->addChild(new Block_Footer);

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
            $product = new Model_Product();
            $id = $req->getGet($product->getPrimaryKey());

            if ($id) {
                $product->{$product->getPrimaryKey()} = $id;
                $product->updatedDate = null;
            }
            $product->setData($req->getPost('product'));
            $product->status = $product->status ? Model_Product::STATUS_ENABLED : Model_Product::STATUS_DISABLED;
            $result = $product->save();
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
            $product = new Model_Product();

            $id = $this->getRequest()->getGet($product->getPrimaryKey());
            if (!$id) {
                throw new Exception('Invalid Action. Id not found.');
            }
            if (!$product->load($id)) {
                throw new Exception('Could not load data.');
            }
            if (!$product->delete()) {
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
            $product = new Model_Product();
    
            $id = $this->getRequest()->getGet($product->getPrimaryKey());
            if (!$id) {
                throw new Exception('Invalid Action. Could not find ID.');
            }
            if (!$product->load($id)) {
                throw new Exception('Could not load data.');
            }
            $result = $product->setData(['status' => (1 - $product->status), 'updatedDate' => null])->save();
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