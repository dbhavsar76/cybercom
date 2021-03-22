<?php
namespace Controller\Admin;

use Block\Admin\Brand\Grid;
use Block\Admin\Layout;
use Block\Core\Message;
use Model\Brand as ModelBrand;

class Brand extends \Controller\Core\Admin {

    public function gridAction() {
        try {
            $gridBlock = new Grid();
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
            $response->addElement('#message', $messageHtml);
            $this->getMessageService()->clearMessage();
        }

        $response->send();
    }
    
    public function addAction() {
        try {
            $tabsBlock = new \Block\Admin\Brand\Edit\Tabs(true);
            $tabsHtml = $tabsBlock->render();
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
            $id = $this->getRequest()->getGet((new ModelBrand)->getPrimaryKey());
            if (!$id) {
                throw new \Exception('Invalid Action. Id not found.');
            }

            $tabsHtml = (new \Block\Admin\Brand\Edit\Tabs)->render();
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
            $id = $this->getRequest()->getGet((new ModelBrand)->getPrimaryKey());

            $formHtml = (new \Block\Admin\Brand\Edit((int)$id))->render();
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
            $request = $this->getRequest();
            if (!$request->isPost()) {
                throw new \Exception("Invalid Request.");
            }
            $brand = new ModelBrand();
            $id = $request->getGet($brand->getPrimaryKey());
            if ($id) {
                $brand->{$brand->getPrimaryKey()} = $id;
            }
            $logo = $_FILES['logo'];
            if (!$id && (!$logo || $logo['error'])) {
                throw new \Exception('Image was not uploaded');
            }
            $brandData = $request->getPost('brand',[]);
            $brand->setData($brandData);
            $result = $brand->save();
            if (!$result) {
                throw new \Exception('Something went wrong. Could not save data.');
            }
            if ($result !== true) {
                $brand->{$brand->getPrimaryKey()} = $result;
            }

            if (!$logo['error']) {
                if (!$brand->uploadImage($logo)) {
                    throw new \Exception('Could not save image.');
                }
            }
            $this->getMessageService()->setSuccess('Record saved successfully.');
        } catch (\Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
        } finally {
            $this->gridAction();
        }
    }

    public function deleteAction() {
        try {
            $brand = new ModelBrand();

            $id = $this->getRequest()->getGet($brand->getPrimaryKey());
            if (!$id) {
                throw new \Exception('Invalid Action. Id not found.');
            }
            if (!$brand->load($id)) {
                throw new \Exception('Could not load data.');
            }
            if (!$brand->delete()) {
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
            $brand = new ModelBrand();

            $id = $this->getRequest()->getGet($brand->getPrimaryKey());
            if (!$id) {
                throw new \Exception('Invalid Action. Could not find ID.');
            }
            if (!$brand->load($id)) {
                throw new \Exception('Could not load data.');
            }
            $result = $brand->setData(['status' => ($brand->status == ModelBrand::STATUS_ENABLED ? ModelBrand::STATUS_DISABLED : ModelBrand::STATUS_ENABLED)])->save();
            if (!$result) {
                throw new \Exception('Something went wrong. Could not save data.');
            }
            $this->getMessageService()->setSuccess('Status changed successfully.');
        } catch (\Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
        } finally {
            $this->gridAction();
        }
    }

}