<?php

class Controller_Customer extends Controller_Core_Base {
    public function __construct() {
        parent::__construct();
        $this->setMessageService(new Model_Admin_Message);
    }

    public function gridAction() {
        try {
            $gridHtml = (new Block_Customer_Grid)->render();
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
            $tabsHtml = (new Block_Customer_Form_Tabs)->render();
            $formHtml = (new Block_Customer_Form)->render();
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
            $id = $this->getRequest()->getGet((new Model_Customer)->getPrimaryKey());
            if (!$id) {
                throw new Exception('Invalid Action. Id not found.');
            }

            $tabsHtml = (new Block_Customer_Form_Tabs)->render();
            $formHtml = (new Block_Customer_Form((int)$id))->render();
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
            $customer = new Model_Customer();
            $id = $request->getGet($customer->getPrimaryKey());
            if ($id) {
                $customer->{$customer->getPrimaryKey()} = $id;
            }
            $tab = $request->getGet('tab', Block_Customer_Form_Tabs::getDefaultTab());
            if ($tab == 'information') {
                $customerData = $request->getPost('customer',[]);
                if (array_key_exists('password', $customerData)){
                    if (!empty($customerData['password'])) {
                        $customerData['password'] = md5($customerData['password']);
                    } else {
                        unset($customerData['password']);
                    }
                }
                if (array_key_exists('password2', $customerData)) {
                    unset($customerData['password2']);
                }
                $customer->setData($customerData);
                $customer->status = $customer->status ? Model_Customer::STATUS_ENABLED : Model_Customer::STATUS_DISABLED;
                $result = $customer->save();
                $addresIds = explode(',', $customer->addressIds);
            } else if ($tab == 'address') {
                if (!$id) {
                    throw new Exception('Id not found.');
                }
                $billingAddressId = $request->getGet('billingAddressId');
                $shippingAddressId = $request->getGet('shippingAddressId');
                $billingAddress = (new Model_CustomerAddress)->setData($request->getPost('billingAddress', []));
                if ($request->getPost('copyAddress')) {
                    $shippingAddress = (new Model_CustomerAddress)->setData($request->getPost('billingAddress', []));
                    $shippingAddress->setData(['type' => 'shipping']);
                } else {
                    $shippingAddress = (new Model_CustomerAddress)->setData($request->getPost('shippingAddress', []));
                }
                if ($billingAddressId) {
                    $billingAddress->{$billingAddress->getPrimaryKey()} = $billingAddressId;
                }
                if ($shippingAddressId) {
                    $shippingAddress->{$shippingAddress->getPrimaryKey()} = $shippingAddressId;
                }
                $billingAddress->setData(['customerId' => $id]);
                $shippingAddress->setData(['customerId' => $id]);
                $result = $billingAddress->save() && $shippingAddress->save();
            }
            if (!$result) {
                throw new Exception('Something went wrong. Could not save data.');
            }
            $this->getMessageService()->setSuccess('Record saved successfully.'.$tab);
            if ($tab == 'information') {
                $_GET = array_merge($_GET, [$customer->getPrimaryKey() => $id ?? $result, 'billingAddressId' => $addresIds[0] ?? '', 'shippingAddressId' => $addresIds[1] ?? '', 'tab'=>'address']);
                $this->editAction();
            } else if ($tab == 'address') {
                $this->gridAction();
            }
        } catch (Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
            $this->gridAction();
        }
    }
    
    public function deleteAction() {
        try {
            $customer = new Model_Customer();

            $id = $this->getRequest()->getGet($customer->getPrimaryKey());
            if (!$id) {
                throw new Exception('Invalid Action. Id not found.');
            }
            if (!$customer->load($id)) {
                throw new Exception('Could not load data.');
            }
            if (!$customer->delete()) {
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
            $customer = new Model_Customer();
    
            $id = $this->getRequest()->getGet($customer->getPrimaryKey());
            if (!$id) {
                throw new Exception('Invalid Action. Could not find ID.');
            }
            if (!$customer->load($id)) {
                throw new Exception('Could not load data.');
            }
            $status = $customer->status;
            $result = $customer->resetData()->setData([$customer->getPrimaryKey() => $id, 'status' => (1 - $status), 'updatedDate' => null])->save();
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