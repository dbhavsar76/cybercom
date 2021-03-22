<?php
namespace Controller\Admin;

use Block\Admin\CmsPage\Grid;
use Block\Core\{Message, Layout};
use Model\CmsPage as ModelCmsPage;

class CmsPage extends \Controller\Core\Admin {

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
            $tabsHtml = (new \Block\Admin\CmsPage\Edit\Tabs)->render();
        } catch (\Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
        }
        
        $response = $this->getResponse();
        $response->setStatus('success');
        $response->setLayout(Layout::LAYOUT_TWO_COLUMNS_WITH_LEFT_SIDEBAR);
        $response->addElement('#left', $tabsHtml);

        $message = $this->getMessageService()->getMessage();
        if ($message) {
                $response['element'][] = [
                    'selector' => '#message',
                    'html' => (new Message($message))->render()
                ];
            $this->getMessageService()->clearMessage();
        }

        $response->send();
    }

    public function editAction() {
        try {
            $id = $this->getRequest()->getGet((new \Model\CmsPage)->getPrimaryKey());
            if (!$id) {
                throw new \Exception('Invalid Action. Id not found.');
            }

            $tabsHtml = (new \Block\Admin\CmsPage\Edit\Tabs)->render();
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
            $id = $this->getRequest()->getGet((new \Model\CmsPage)->getPrimaryKey());

            $formHtml = (new \Block\Admin\CmsPage\Edit((int)$id))->render();
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
            if (!$req->isPost() || empty($_SERVER['HTTP_REFERER'])) {
                throw new \Exception("Invalid Request");
            }
            $cmsPage = new \Model\CmsPage();
            $id = $req->getGet($cmsPage->getPrimaryKey());

            if ($id) {
                $cmsPage->{$cmsPage->getPrimaryKey()} = $id;
            }

            $cmsPage->setData($req->getPost('cmsPage'));
            $cmsPage->status = $cmsPage->status ? \Model\CmsPage::STATUS_ENABLED : \Model\CmsPage::STATUS_DISABLED;
            $cmsPage->content = htmlentities($cmsPage->content);
            $result = $cmsPage->save();
            if (!$result) {
                throw new \Exception('Something went wrong. Could not save data.');
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
            $cmsPage = new \Model\CmsPage();

            $id = $this->getRequest()->getGet($cmsPage->getPrimaryKey());
            if (!$id) {
                throw new \Exception('Invalid Action. Id not found.');
            }
            if (!$cmsPage->load($id)) {
                throw new \Exception('Could not load data.');
            }
            if (!$cmsPage->delete()) {
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
            $cmsPage = new \Model\CmsPage();

            $id = $this->getRequest()->getGet($cmsPage->getPrimaryKey());
            if (!$id) {
                throw new \Exception('Invalid Action. Could not find ID.');
            }
            if (!$cmsPage->load($id)) {
                throw new \Exception('Could not load data.');
            }
            $result = $cmsPage->setData(['status' => ($cmsPage->status == ModelCmsPage::STATUS_ENABLED ? ModelCmsPage::STATUS_DISABLED : ModelCmsPage::STATUS_ENABLED)])->save();
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