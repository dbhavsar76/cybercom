<?php
namespace Controller\Admin;

class ShippingMethod extends \Controller\Core\Base {
    public function __construct() {
        parent::__construct();
        $this->setMessageService(new \Model\Admin\Message);
    }

    public function gridAction() {
        try {
            $gridHtml = (new \Block\Admin\ShippingMethod\Grid)->render();
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
            $tabsHtml = (new \Block\Admin\ShippingMethod\Edit\Tabs)->render();
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
            $id = $this->getRequest()->getGet((new \Model\ShippingMethod)->getPrimaryKey());
            if (!$id) {
                throw new \Exception('Invalid Action. Id not found.');
            }

            $tabsHtml = (new \Block\Admin\ShippingMethod\Edit\Tabs)->render();
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
            $id = $this->getRequest()->getGet((new \Model\ShippingMethod)->getPrimaryKey());

            $formHtml = (new \Block\Admin\ShippingMethod\Edit((int)$id))->render();
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
            $req = $this->getRequest();
            if (!$req->isPost() || empty($_SERVER['HTTP_REFERER'])) {
                throw new \Exception('Invalid Request.');
            }
            $shippingMethod = new \Model\ShippingMethod();
            $id = $req->getGet($shippingMethod->getPrimaryKey());

            if ($id) {
                $shippingMethod->{$shippingMethod->getPrimaryKey()} = $id;
            }

            $shippingMethod->setData($req->getPost('shippingMethod', []));
            $shippingMethod->status = $shippingMethod->status ? \Model\ShippingMethod::STATUS_ENABLED : \Model\ShippingMethod::STATUS_DISABLED;
            $result = $shippingMethod->save();
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
            $shippingMethod = new \Model\ShippingMethod();

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
            $shippingMethod = new \Model\ShippingMethod();

            $id = $this->getRequest()->getGet($shippingMethod->getPrimaryKey());
            if (!$id) {
                throw new \Exception('Invalid Action. Could not find ID.');
            }
            if (!$shippingMethod->load($id)) {
                throw new \Exception('Could not load data.');
            }
            $result = $shippingMethod->setData(['status' => (1 - $shippingMethod->status)])->save();
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