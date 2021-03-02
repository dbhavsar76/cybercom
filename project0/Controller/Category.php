<?php

class Controller_Category extends Controller_Core_Base {
    public function __construct() {
        parent::__construct();
        $this->setMessageService(new Model_Admin_Message);
    }

    public function gridAction() {
        try {
            $layout = $this->getLayout();
            $layout->prepareChildren(Block_Core_Layout::LAYOUT_ONE_COLUMN);
            $layout->getChild('header')->addChild(new Block_Header);
            $layout->getChild('content')->addChild(new Block_Category_Grid);
            $layout->getChild('footer')->addChild(new Block_Footer);

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
            $layout->getLeft()->addChild(new Block_Category_Form_Tabs);
            $layout->getContent()->addChild(new Block_Category_Form);
            $layout->getFooter()->addChild(new Block_Footer);

            echo $layout->render();
        } catch (Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
            Model_Core_UrlManager::redirect('grid', null, null, true);
        }
    }

    public function editAction() {
        try {
            $id = $this->getRequest()->getGet((new Model_Category)->getPrimaryKey());
            if (!$id) {
                throw new Exception('Invalid Action. Id not found.');
            }
            $layout = $this->getLayout();
            $layout->prepareChildren(Block_Core_Layout::LAYOUT_TWO_COLUMNS_WITH_LEFT_SIDEBAR);
            $layout->getChild('header')->addChild(new Block_Header);
            $layout->getLeft()->addChild(new Block_Category_Form_Tabs);
            $layout->getChild('content')->addChild(new Block_Category_Form((int)$id));
            $layout->getChild('footer')->addChild(new Block_Footer);

            echo $layout->render();
        } catch (Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
            Model_Core_UrlManager::redirect('grid', null, null, true);
        }
    }

    public function saveAction() {
        try {
            $request = $this->getRequest();
            if (!$request->isPost() || empty($_SERVER['HTTP_REFERER'])) {
                throw new Exception("Invalid Request.");
            }
            $category = new Model_Category();
            $id = $request->getGet($category->getPrimaryKey());
            if ($id) {
                $category->{$category->getPrimaryKey()} = $id;
            }
            $category->setData($request->getPost('category', []));
            $category->status = $category->status ? Model_Category::STATUS_ENABLED : Model_Category::STATUS_DISABLED;
            
            $result = $category->save();
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
            $category = new Model_Category();

            $id = $this->getRequest()->getGet($category->getPrimaryKey());
            if (!$id) {
                throw new Exception('Invalid Action. Id not found.');
            }
            if (!$category->load($id)) {
                throw new Exception('Could not load data.');
            }
            if (!$category->delete()) {
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
            $category = new Model_Category();
    
            $id = $this->getRequest()->getGet($category->getPrimaryKey());
            if (!$id) {
                throw new Exception('Invalid Action. Could not find ID.');
            }
            if (!$category->load($id)) {
                throw new Exception('Could not load data.');
            }
            $result = $category->setData(['status' => (1 - $category->status)])->save();
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