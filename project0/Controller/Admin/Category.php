<?php
namespace Controller\Admin;

use Block\Core\{Message, Layout};

class Category extends \Controller\Core\Admin {

    public function gridAction() {
        try {
            $gridHtml = (new \Block\Admin\Category\Grid)->render();
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
            $tabsHtml = (new \Block\Admin\Category\Edit\Tabs)->render();
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
            $id = $this->getRequest()->getGet((new \Model\Category)->getPrimaryKey());
            if (!$id) {
                throw new \Exception('Invalid Action. Id not found.');
            }

            $tabsHtml = (new \Block\Admin\Category\Edit\Tabs)->render();
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

    public function saveAction() {
        try {
            $request = $this->getRequest();
            if (!$request->isPost() || empty($_SERVER['HTTP_REFERER'])) {
                throw new \Exception("Invalid Request.");
            }
            $category = new \Model\Category();
            $primaryKey = $category->getPrimaryKey();
            $id = $request->getGet($primaryKey);
            if ($id) {
                $category->$primaryKey = $id;
            }
            $category->setData($request->getPost('category', []));
            $category->status = $category->status ? \Model\Category::STATUS_ENABLED : \Model\Category::STATUS_DISABLED;
            
            $result = $category->save();
            if (!$result) {
                throw new \Exception('Something went wrong. Could not save data.');
            }

            $category->$primaryKey ??=  $result;
            $parent = new \Model\Category;
            $parent->load($category->parentId);
            $result = $category->updatePath($parent);
            if (!$result) {
                throw new \Exception('Something went wrong. Could not save data properly.');
            }

            $this->getMessageService()->setSuccess('Record saved successfully.');
        } catch (\Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
        } finally {
            $this->gridAction();
        }
    }
    
    public function tabAction() {
        try {
            $id = $this->getRequest()->getGet((new \Model\Category)->getPrimaryKey());

            $formHtml = (new \Block\Admin\Category\Edit((int)$id))->render();
        } catch (\Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
        } finally {
            $response = [
                'status' => 'success',
                'element' => [
                    [
                        'selector' => '#content',
                        'html' => $formHtml
                    ],
                ]
            ];

            $message = $this->getMessageService()->getMessage();
            if ($message) {
                $response['element'][] = [
                    'selector' => '#message',
                    'html' => (new Message($message))->render()
                ];
                $this->getMessageService()->clearMessage();
            }

            header("Content-type: application/json; charset=utf-8");
            echo json_encode($response);
        }
    }

    public function deleteAction() {
        try {
            $category = new \Model\Category();

            $id = $this->getRequest()->getGet($category->getPrimaryKey());
            if (!$id) {
                throw new \Exception('Invalid Action. Id not found.');
            }
            if (!$category->load($id)) {
                throw new \Exception('Could not load data.');
            }
            if (!$category->delete()) {
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
            $category = new \Model\Category();
    
            $id = $this->getRequest()->getGet($category->getPrimaryKey());
            if (!$id) {
                throw new \Exception('Invalid Action. Could not find ID.');
            }
            if (!$category->load($id)) {
                throw new \Exception('Could not load data.');
            }
            $result = $category->setData(['status' => (1 - $category->status)])->save();
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