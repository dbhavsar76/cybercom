<?php
namespace Controller\Admin;

class Admin extends \Controller\Core\Base {
    public function __construct() {
        parent::__construct();
        $this->setMessageService(new \Model\Admin\Message);
    }

    public function gridAction() {
        try {
            $gridHtml = (new \Block\Admin\Admin\Grid)->render();
        } catch (\Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
        } finally {
            $response = [
                'status' => 'success',
                'layout' => \Block\Core\Layout::LAYOUT_ONE_COLUMN,
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
                    'html' => (new \Block\Core\Message($message))->render()
                ];
                $this->getMessageService()->clearMessage();
            }

            header("Content-type: application/json; charset=utf-8");
            echo json_encode($response);
        }
    }

    public function addAction() {
        try {
            $tabsHtml = (new \Block\Admin\Admin\Edit\Tabs)->render();
        } catch (\Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
        } finally {
            $response = [
                'status' => 'success',
                'layout' => \Block\Core\Layout::LAYOUT_TWO_COLUMNS_WITH_LEFT_SIDEBAR,
                'element' => [
                    [
                        'selector' => '#left',
                        'html' => $tabsHtml
                    ],
                ]
            ];

            $message = $this->getMessageService()->getMessage();
            if ($message) {
                $response['element'][] = [
                    'selector' => '#message',
                    'html' => (new \Block\Core\Message($message))->render()
                ];
                $this->getMessageService()->clearMessage();
            }

            header("Content-type: application/json; charset=utf-8");
            echo json_encode($response);
        }
    }

    public function editAction() {
        try {
            $id = $this->getRequest()->getGet((new \Model\Admin)->getPrimaryKey());
            if (!$id) {
                throw new \Exception('Invalid Action. Id not found.');
            }

            $tabsHtml = (new \Block\Admin\Admin\Edit\Tabs)->render();
        } catch (\Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
        } finally {
            $response = [
                'status' => 'success',
                'layout' => \Block\Core\Layout::LAYOUT_TWO_COLUMNS_WITH_LEFT_SIDEBAR,
                'element' => [
                    [
                        'selector' => '#left',
                        'html' => $tabsHtml
                    ],
                ]
            ];

            $message = $this->getMessageService()->getMessage();
            if ($message) {
                $response['element'][] = [
                    'selector' => '#message',
                    'html' => (new \Block\Core\Message($message))->render()
                ];
                $this->getMessageService()->clearMessage();
            }

            header("Content-type: application/json; charset=utf-8");
            echo json_encode($response);
        }
    }

    public function tabAction() {
        try {
            $id = $this->getRequest()->getGet((new \Model\Admin)->getPrimaryKey());

            $formHtml = (new \Block\Admin\Admin\Edit((int)$id))->render();
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
                    'html' => (new \Block\Core\Message($message))->render()
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
                throw new \Exception("Invalid Request.");
            }
            $admin = new \Model\Admin();
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
            $admin->status = $admin->status ? \Model\Admin::STATUS_ENABLED : \Model\Admin::STATUS_DISABLED;
            $result = $admin->save();
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
            $admin = new \Model\Admin();

            $id = $this->getRequest()->getGet($admin->getPrimaryKey());
            if (!$id) {
                throw new \Exception('Invalid Action. Id not found.');
            }
            if (!$admin->load($id)) {
                throw new \Exception('Could not load data.');
            }
            if (!$admin->delete()) {
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
            $admin = new \Model\Admin();

            $id = $this->getRequest()->getGet($admin->getPrimaryKey());
            if (!$id) {
                throw new \Exception('Invalid Action. Could not find ID.');
            }
            if (!$admin->load($id)) {
                throw new \Exception('Could not load data.');
            }
            $result = $admin->setData(['status' => (1 - $admin->status), 'updatedDate' => null])->save();
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