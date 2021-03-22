<?php
namespace Controller\Admin;

use Block\Core\{Message, Layout};
use Block\Admin\ShippingMethod\Grid;
use Block\Admin\ShippingMethod\Edit;
use Block\Admin\ShippingMethod\Edit\Tabs;
use Model\Core\UrlManager;
use Model\ShippingMethod as ModelShippingMethod;

class ShippingMethod extends \Controller\Core\Admin {

    public function gridAction() {
        try {
            $gridBlock = new Grid;
            $filter = $this->getFilterService()->getFilter(get_class($gridBlock));
            $gridBlock->prepareCollection($filter);
            $gridHtml = $gridBlock->render();
        } catch (\Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
        }

        $response = $this->getResponse();
        $response->setStatus('success');
        $response->setLayout(Layout::LAYOUT_ONE_COLUMN);
        if ($gridHtml) {
            $response->addElement('#content', $gridHtml);
        }

        $message = $this->getMessageService()->getMessage();
        if ($message) {
            $messageHtml = (new Message($message))->render();
            $this->getMessageService()->clearMessage();
            $response->addElement('#message', $messageHtml);
        }

        $response->send();
    }

    public function addAction() {
        try {
            $tabsHtml = (new Tabs)->render();
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
            $id = $this->getRequest()->getGet((new ModelShippingMethod)->getPrimaryKey());
            if (!$id) {
                throw new \Exception('Invalid Action. Id not found.');
            }

            $tabsHtml = (new Tabs)->render();
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
            $id = $this->getRequest()->getGet((new ModelShippingMethod)->getPrimaryKey());

            $formHtml = (new Edit((int)$id))->render();
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
            $req = $this->getRequest();
            if (!$req->isPost()) {
                throw new \Exception('Invalid Request.');
            }
            $shippingMethod = new ModelShippingMethod();
            $id = $req->getGet($shippingMethod->getPrimaryKey());

            if ($id) {
                $shippingMethod->{$shippingMethod->getPrimaryKey()} = $id;
            }

            $shippingMethod->setData($req->getPost('shippingMethod', []));
            $shippingMethod->status = $shippingMethod->status ? ModelShippingMethod::STATUS_ENABLED : ModelShippingMethod::STATUS_DISABLED;
            $result = $shippingMethod->save();
            if (!$result) {
                throw new \Exception('Something went wrong. Could not save data.');
            }
            $this->getMessageService()->setSuccess('Record saved successfully.');
        } catch (\Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
        } finally {
            $this->getResponse()->setAjaxRedirect(UrlManager::getUrl('grid', null, null, true))->send();
        }
    }
    
    public function deleteAction() {
        try {
            $shippingMethod = new ModelShippingMethod();

            $id = $this->getRequest()->getGet($shippingMethod->getPrimaryKey());
            if (!$id) {
                throw new \Exception('Invalid Action. Id not found.');
            }
            if (!$shippingMethod->load($id)) {
                throw new \Exception('Could not load data.');
            }
            if (!$shippingMethod->delete()) {
                throw new \Exception('Could not delete record.');
            }
            $this->getMessageService()->setSuccess('Record deleted successfully.');
        } catch (\Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
        } finally {
            $this->gridAction();
        }
    }

    public function toggleStatusAction() {
        try {
            $shippingMethod = new ModelShippingMethod();

            $id = $this->getRequest()->getGet($shippingMethod->getPrimaryKey());
            if (!$id) {
                throw new \Exception('Invalid Action. Could not find ID.');
            }
            if (!$shippingMethod->load($id)) {
                throw new \Exception('Could not load data.');
            }
            $result = $shippingMethod->setData(['status' => ($shippingMethod->status == ModelShippingMethod::STATUS_ENABLED ? ModelShippingMethod::STATUS_DISABLED : ModelShippingMethod::STATUS_ENABLED)])->save();
            if (!$result) {
                throw new \Exception('Something went wrong. Could not save data.');
            }
            $this->getMessageService()->setSuccess('Status changed successfully.');
        } catch (\Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
        } finally {
            $this->getResponse()->setAjaxRedirect(UrlManager::getUrl('grid', null, null, true))->send();
        }
    }
}