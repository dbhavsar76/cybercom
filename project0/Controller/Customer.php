<?php

class Controller_Customer extends Controller_Core_Base {
    public function __construct() {
        parent::__construct();
        $this->setMessageService(new Model_Admin_Message);
    }

    public function gridAction() {
        try {
            $layout = $this->getLayout();
            $layout->prepareChildren(Block_Core_Layout::LAYOUT_ONE_COLUMN);
            $layout->getHeader()->addChild(new Block_Header);            
            $layout->getContent()->addChild(new Block_Customer_Grid);
            $layout->getFooter()->addChild(new Block_footer);

            echo $layout->render();
        } catch (Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
            Model_Core_UrlManager::redirect('grid', null, null, true);
        }
    }

    public function addAction() {
        try {
            $layout = $this->getLayout();
            $layout->prepareChildren(Block_Core_Layout::LAYOUT_TWO_COLUMNS_WITH_LEFT_SIDEBAR);
            $layout->getHeader()->addChild(new Block_Header);
            $layout->getLeft()->addChild(new Block_Customer_Form_Tabs);
            $layout->getContent()->addChild(new Block_Customer_Form);
            $layout->getFooter()->addChild(new Block_footer);

            echo $layout->render();
        } catch (Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
            Model_Core_UrlManager::redirect('grid', null, null, true);
        }
    }

    public function editAction() {
        try {
            $id = $this->getRequest()->getGet((new Model_Customer)->getPrimaryKey());
            if (!$id) {
                throw new Exception('Invalid Action.');
            }
            $layout = $this->getLayout();
            $layout->prepareChildren(Block_Core_Layout::LAYOUT_TWO_COLUMNS_WITH_LEFT_SIDEBAR);
            $layout->getHeader()->addChild(new Block_Header);
            $layout->getLeft()->addChild(new Block_Customer_Form_Tabs);
            $layout->getContent()->addChild(new Block_Customer_Form((int)$id));
            $layout->getFooter()->addChild(new Block_footer);

            echo $layout->render();
        } catch (Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
            Model_Core_UrlManager::redirect('grid', null, null, true);
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
                $billingAddress = (new Model_CustomerAddress)->setData($request->getPost('billingAddress', []));
                if ($request->getPost('copyAddress')) {
                    $shippingAddress = (new Model_CustomerAddress)->setData($request->getPost('billingAddress', []));
                    $shippingAddress->setData(['type' => 'shipping']);
                } else {
                    $shippingAddress = (new Model_CustomerAddress)->setData($request->getPost('shippingAddress', []));
                }
                $billingAddress->setData(['customerId' => $id]);
                $shippingAddress->setData(['customerId' => $id]);
                $result = $billingAddress->save() && $shippingAddress->save();
            }
            if (!$result) {
                throw new Exception('Something went wrong. Could not save data.');
            }
            $this->getMessageService()->setSuccess('Record saved successfully.');
            if ($tab == 'information') {
                Model_Core_UrlManager::redirect('edit', null, [$customer->getPrimaryKey() => $id ?? $result, 'billingAddressId' => $addresIds[0] ?? '', 'shippingAddressId' => $addresIds[1] ?? '', 'tab'=>'address']);
            } else if ($tab == 'address') {
                Model_Core_UrlManager::redirect('grid', null, null, true);
            }
        } catch (Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
            Model_Core_UrlManager::redirect(-1);
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
            Model_Core_UrlManager::redirect('grid', null, null, true);
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
            Model_Core_UrlManager::redirect('grid', null, null, true);
        }
    }
}