<?php

class Controller_CustomerGroup extends Controller_Core_Base {
    public function __construct() {
        parent::__construct();
        $this->setMessageService(new Model_Admin_Message);
    }

    public function gridAction() {
        try {
            $layout = $this->getLayout();
            $layout->prepareChildren(Block_Core_Layout::LAYOUT_ONE_COLUMN);
            $layout->getChild('header')->addChild(new Block_Header);
            $layout->getChild('content')->addChild(new Block_CustomerGroup_Grid);
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
            $layout->getLeft()->addChild(new Block_CustomerGroup_Form_Tabs);
            $layout->getContent()->addChild(new Block_CustomerGroup_Form);
            $layout->getFooter()->addChild(new Block_Footer);

            echo $layout->render();
        } catch (Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
            Model_Core_UrlManager::redirect('grid', null, null, true);
        }
    }

    public function editAction() {
        try {
            $id = $this->getRequest()->getGet((new Model_CustomerGroup)->getPrimaryKey());
            if (!$id) {
                throw new Exception('Invalid Action. Id not found.');
            }
            $layout = $this->getLayout();
            $layout->prepareChildren(Block_Core_Layout::LAYOUT_TWO_COLUMNS_WITH_LEFT_SIDEBAR);
            $layout->getChild('header')->addChild(new Block_Header);
            $layout->getLeft()->addChild(new Block_CustomerGroup_Form_Tabs);
            $layout->getChild('content')->addChild(new Block_CustomerGroup_Form((int)$id));
            $layout->getChild('footer')->addChild(new Block_Footer);

            echo $layout->render();
        } catch (Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
            Model_Core_UrlManager::redirect('grid', null, null, true);
        }
    }

    public function saveAction() {
        try {
            $makeDefault = false;
            $request = $this->getRequest();
            if (!$request->isPost() || empty($_SERVER['HTTP_REFERER'])) {
                throw new Exception("Invalid Request.");
            }
            $customerGroup = new Model_CustomerGroup();
            $id = $request->getGet($customerGroup->getPrimaryKey());
            if ($id) {
                $customerGroup->{$customerGroup->getPrimaryKey()} = $id;
            }

            $customerGroupData = $request->getPost('customerGroup', []);
            if (array_key_exists('default', $customerGroupData)) {
                unset($customerGroupData['default']);
                $makeDefault = true;
            }
            $customerGroup->setData($customerGroupData);
            
            $result = $customerGroup->save();
            if (!$result) {
                throw new Exception('Something went wrong. Could not save data.');
            }
            if ($makeDefault) {
                Model_Core_UrlManager::redirect('makeDefault', null, [$customerGroup->getPrimaryKey() => $id ?? $result], true);
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
            $customerGroup = new Model_CustomerGroup();

            $id = $this->getRequest()->getGet($customerGroup->getPrimaryKey());
            if (!$id) {
                throw new Exception('Invalid Action. Id not found.');
            }
            if (!$customerGroup->load($id)) {
                throw new Exception('Could not load data.');
            }
            if (!$customerGroup->delete()) {
                throw new Exception('Could not delete record.');
            }
            $this->getMessageService()->setSuccess('Record deleted successfully.');
        } catch (Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
        } finally {
            Model_Core_UrlManager::redirect('grid', null, null, true);
        }
    }

    public function makeDefaultAction() {
        try {
            $customerGroup = new Model_CustomerGroup();
    
            $id = $this->getRequest()->getGet($customerGroup->getPrimaryKey());
            if (!$id) {
                throw new Exception('Invalid Action. Could not find ID.');
            }
            if (!$customerGroup->load($id)) {
                throw new Exception('Could not load data.');
            }
            $result = $customerGroup->makeDefault();
            if (!$result) {
                throw new Exception('Something went wrong. Could not save data.');
            }
            $this->getMessageService()->setSuccess('Default group changed successfully.');
        } catch (Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
        } finally {
           Model_Core_UrlManager::redirect('grid', null, null, true);
       }
    }
}