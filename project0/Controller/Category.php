<?php

class Controller_Category extends Controller_Core_Base {
    public function __construct() {
        parent::__construct();
        $this->setMessageService(new Model_Admin_Message);
    }

    public function gridAction() {
        try {
            $gridHtml = (new Block_Category_Grid)->render();
        } catch (Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
        } finally {
            $response = [
                'status' => 'success',
                'layout' => Block_Core_Layout::LAYOUT_ONE_COLUMN,
                'element' => [
                    [
                        'selector' => '#content',
                        'html' => $gridHtml
                    ],
                ]
            ];

            $message = $this->getMessageService()->getMessage();
            if ($message) {
                $response['element'][] = [
                    'selector' => '#message',
                    'html' => (new Block_Core_Message($message))->render()
                ];
                $this->getMessageService()->clearMessage();
            }

            header("Content-type: application/json; charset=utf-8");
            echo json_encode($response);
        }
    }

    public function addAction() {
        try {
            $tabsHtml = (new Block_Category_Form_Tabs)->render();
            $formHtml = (new Block_Category_Form)->render();
        } catch (Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
        } finally {
            $response = [
                'status' => 'success',
                'layout' => Block_Core_Layout::LAYOUT_TWO_COLUMNS_WITH_LEFT_SIDEBAR,
                'element' => [
                    [
                        'selector' => '#left',
                        'html' => $tabsHtml
                    ],
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
                    'html' => (new Block_Core_Message($message))->render()
                ];
                $this->getMessageService()->clearMessage();
            }

            header("Content-type: application/json; charset=utf-8");
            echo json_encode($response);
        }
    }

    public function editAction() {
        try {
            $id = $this->getRequest()->getGet((new Model_Category)->getPrimaryKey());
            if (!$id) {
                throw new Exception('Invalid Action. Id not found.');
            }

            $tabsHtml = (new Block_Category_Form_Tabs)->render();
            $formHtml = (new Block_Category_Form((int)$id))->render();
        } catch (Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
        } finally {
            $response = [
                'status' => 'success',
                'layout' => Block_Core_Layout::LAYOUT_TWO_COLUMNS_WITH_LEFT_SIDEBAR,
                'element' => [
                    [
                        'selector' => '#left',
                        'html' => $tabsHtml
                    ],
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
                    'html' => (new Block_Core_Message($message))->render()
                ];
                $this->getMessageService()->clearMessage();
            }

            header("Content-type: application/json; charset=utf-8");
            echo json_encode($response);
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
        } catch (Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
        } finally {
            $this->gridAction();
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
            $this->gridAction();
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
            $this->gridAction();
        }
    }
}