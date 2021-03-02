<?php

class Controller_Admin extends Controller_Core_Base {
    public function __construct() {
        parent::__construct();
        $this->setMessageService(new Model_Admin_Message);
    }

    public function gridAction() {
        try {
            $layout = $this->getLayout();
            $layout->prepareChildren(Block_Core_Layout::LAYOUT_ONE_COLUMN);
            $layout->getHeader()->addChild(new Block_Header);
            $layout->getContent()->addChild(new Block_Admin_Grid);
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
            $layout->getLeft()->addChild(new Block_Admin_Form_Tabs);
            $layout->getContent()->addChild(new Block_Admin_Form);
            $layout->getFooter()->addChild(new Block_Footer);

            echo $layout->render();
        } catch (Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
            Model_Core_UrlManager::redirect('grid', null, null, true);
        }
    }

    public function editAction() {
        try {
            $id = $this->getRequest()->getGet((new Model_admin)->getPrimaryKey());
            if (!$id) {
                throw new Exception('Invalid Action. Id not found.');
            }
        
            $layout = $this->getLayout();
            $layout->prepareChildren(Block_Core_Layout::LAYOUT_TWO_COLUMNS_WITH_LEFT_SIDEBAR);
            $layout->getHeader()->addChild(new Block_Header);
            $layout->getLeft()->addChild(new Block_Admin_Form_Tabs);
            $layout->getContent()->addChild(new Block_Admin_Form((int)$id));
            $layout->getFooter()->addChild(new Block_Footer);

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
            $admin = new Model_Admin();
            $id = $request->getGet($admin->getPrimaryKey());
            if ($id) {
                $admin->{$admin->getPrimaryKey()} = $id;
            }
            $adminData = $request->getPost('admin',[]);
            if (array_key_exists('password', $adminData)){
                if (!empty($adminData['password'])) {
                    $adminData['password'] = md5($adminData['password']);
                } else {
                    unset($adminData['password']);
                }
            }
            if (array_key_exists('password2', $adminData)) {
                unset($adminData['password2']);
            }
            $admin->setData($adminData);
            $admin->status = $admin->status ? Model_Admin::STATUS_ENABLED : Model_Admin::STATUS_DISABLED;
            $result = $admin->save();
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
            $admin = new Model_Admin();

            $id = $this->getRequest()->getGet($admin->getPrimaryKey());
            if (!$id) {
                throw new Exception('Invalid Action. Id not found.');
            }
            if (!$admin->load($id)) {
                throw new Exception('Could not load data.');
            }
            if (!$admin->delete()) {
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
            $admin = new Model_Admin();

            $id = $this->getRequest()->getGet($admin->getPrimaryKey());
            if (!$id) {
                throw new Exception('Invalid Action. Could not find ID.');
            }
            if (!$admin->load($id)) {
                throw new Exception('Could not load data.');
            }
            $result = $admin->setData(['status' => (1 - $admin->status), 'updatedDate' => null])->save();
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