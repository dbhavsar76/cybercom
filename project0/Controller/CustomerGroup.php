<?php

class Controller_CustomerGroup extends Controller_Core_Base {
    public function __construct() {
        parent::__construct();
        $this->setMessageService(new Model_Admin_Message);
    }

    public function gridAction() {
        try {
            $gridHtml = (new Block_CustomerGroup_Grid)->render();
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
            $tabsHtml = (new Block_CustomerGroup_Form_Tabs)->render();
            $formHtml = (new Block_CustomerGroup_Form)->render();
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
            $id = $this->getRequest()->getGet((new Model_CustomerGroup)->getPrimaryKey());
            if (!$id) {
                throw new Exception('Invalid Action. Id not found.');
            }

            $tabsHtml = (new Block_CustomerGroup_Form_Tabs)->render();
            $formHtml = (new Block_CustomerGroup_Form((int)$id))->render();
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
                $_GET[$customerGroup->getPrimaryKey()] = $id ?? $result;
                $this->makeDefaultAction();
                return;
            }
            $this->getMessageService()->setSuccess('Record saved successfully.');
            $this->gridAction();
        } catch (Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
            $this->gridAction();
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
            $this->gridAction();
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
            $this->gridAction();
        }
    }
}