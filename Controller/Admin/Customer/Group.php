<?php
namespace Controller\Admin\Customer;

use Block\Core\{Layout, Message};

class Group extends \Controller\Core\Admin {

    public function gridAction() {
        try {
            $gridHtml = (new \Block\Admin\Customer\Group\Grid)->render();
        } catch (\Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
        }
        
        $response = $this->getResponse();
        $response->setStatus('success');
        $response->setLayout(Layout::LAYOUT_ONE_COLUMN);
        $response->addElement('#content', $gridHtml);

        $message = $this->getMessageService()->getMessage();
        if ($message) {
            $messageHtml = (new Message($message))->render();
            $response->addElement('#message', $messageHtml);
            $this->getMessageService()->clearMessage();
        }

        $response->send();
    }

    public function addAction() {
        try {
            $tabsHtml = (new \Block\Admin\Customer\Group\Edit\Tabs)->render();
        } catch (\Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
        }
        
        $response = $this->getResponse();
        $response->setStatus('success');
        $response->setLayout(Layout::LAYOUT_TWO_COLUMNS_WITH_LEFT_SIDEBAR);
        $response->addElement('#left', $tabsHtml);

        $message = $this->getMessageService()->getMessage();
        if ($message) {
            $messageHtml = (new Message($message))->render();
            $response->addElement('#message', $messageHtml);
            $this->getMessageService()->clearMessage();
        }

        $response->send();
    }

    public function editAction() {
        try {
            $id = $this->getRequest()->getGet((new \Model\Customer\Group)->getPrimaryKey());
            if (!$id) {
                throw new \Exception('Invalid Action. Id not found.');
            }

            $tabsHtml = (new \Block\Admin\Customer\Group\Edit\Tabs)->render();
        } catch (\Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
        }
        
        $response = $this->getResponse();
        $response->setStatus('success');
        if ($tabsHtml) {
            $response->setLayout(Layout::LAYOUT_TWO_COLUMNS_WITH_LEFT_SIDEBAR);
            $response->addElement('#left', $tabsHtml);
        }

        $message = $this->getMessageService()->getMessage();
        if ($message) {
            $messageHtml = (new Message($message))->render();
            $response->addElement('#message', $messageHtml);
            $this->getMessageService()->clearMessage();
        }

        $response->send();
    }

    public function tabAction() {
        try {
            $id = $this->getRequest()->getGet((new \Model\Customer\Group)->getPrimaryKey());

            $formHtml = (new \Block\Admin\Customer\Group\Edit((int)$id))->render();
        } catch (\Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
        }
        
        $response = $this->getResponse();
        $response->setStatus('success');
        $response->addElement('#content', $formHtml);

        $message = $this->getMessageService()->getMessage();
        if ($message) {
            $messageHtml = (new Message($message))->render();
            $response->addElement('#message', $messageHtml);
            $this->getMessageService()->clearMessage();
        }

        $response->send();
    }


    public function saveAction() {
        try {
            $makeDefault = false;
            $request = $this->getRequest();
            if (!$request->isPost() || empty($_SERVER['HTTP_REFERER'])) {
                throw new \Exception("Invalid Request.");
            }
            $customerGroup = new \Model\Customer\Group();
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
                throw new \Exception('Something went wrong. Could not save data.');
            }
            if ($makeDefault) {
                $_GET[$customerGroup->getPrimaryKey()] = $id ?? $result;
                $this->makeDefaultAction();
                return;
            }
            $this->getMessageService()->setSuccess('Record saved successfully.');
            $this->gridAction();
        } catch (\Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
            $this->gridAction();
        }
    }
    
    public function deleteAction() {
        try {
            $customerGroup = new \Model\Customer\Group();

            $id = $this->getRequest()->getGet($customerGroup->getPrimaryKey());
            if (!$id) {
                throw new \Exception('Invalid Action. Id not found.');
            }
            if (!$customerGroup->load($id)) {
                throw new \Exception('Could not load data.');
            }
            if (!$customerGroup->delete()) {
                throw new \Exception('Could not delete record.');
            }
            $this->getMessageService()->setSuccess('Record deleted successfully.');
        } catch (\Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
        } finally {
            $this->gridAction();
        }
    }

    public function makeDefaultAction() {
        try {
            $customerGroup = new \Model\Customer\Group();
    
            $id = $this->getRequest()->getGet($customerGroup->getPrimaryKey());
            if (!$id) {
                throw new \Exception('Invalid Action. Could not find ID.');
            }
            if (!$customerGroup->load($id)) {
                throw new \Exception('Could not load data.');
            }
            $result = $customerGroup->makeDefault();
            if (!$result) {
                throw new \Exception('Something went wrong. Could not save data.');
            }
            $this->getMessageService()->setSuccess('Default group changed successfully.');
        } catch (\Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
        } finally {
            $this->gridAction();
        }
    }
}