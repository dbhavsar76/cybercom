<?php

class Controller_Customer extends Controller_Core_Base {

    public function gridAction() {
        try {
            $layout = $this->getLayout();
            $layout->prepareChildren(Block_Core_Layout::LAYOUT_ONE_COLUMN);
            $layout->getChild('header')->addChild(new Block_Header);
            $layout->getChild('content')->addChild(new Block_Customer_Grid);
            $layout->getChild('footer')->addChild(new Block_footer);

            $layout->render();
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }

    public function addAction() {
        try {
            $layout = $this->getLayout();
            $layout->prepareChildren(Block_Core_Layout::LAYOUT_ONE_COLUMN);
            $layout->getChild('header')->addChild(new Block_Header);
            $layout->getChild('content')->addChild(new Block_Customer_Form);
            $layout->getChild('footer')->addChild(new Block_footer);

            $layout->render();
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }

    public function editAction() {
        try {
            $id = $this->getRequest()->getGet((new Model_Customer)->getPrimaryKey());
            if (!$id) Model_Core_UrlManager::redirect('grid', null, null, true);

            $layout = $this->getLayout();
            $layout->prepareChildren(Block_Core_Layout::LAYOUT_ONE_COLUMN);
            $layout->getChild('header')->addChild(new Block_Header);
            $layout->getChild('content')->addChild(new Block_Customer_Form((int)$id));
            $layout->getChild('footer')->addChild(new Block_footer);

            $layout->render();
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
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
            if ($id) $customer->{$customer->getPrimaryKey()} = $id;

            $customerData = $request->getPost('customer',[]);
            if (array_key_exists('password', $customerData)){
                if (!empty($customerData['password']))
                    $customerData['password'] = md5($customerData['password']);
                else
                    unset($customerData['password']);
            }
            if (array_key_exists('password2', $customerData)) {
                unset($customerData['password2']);
            }
            $customer->setData($customerData);
            $customer->status = $customer->status ? Model_Customer::STATUS_ENABLED : Model_Customer::STATUS_DISABLED;
            $result = $customer->save();
            if (!$result) {
                header('location'.$_SERVER['HTTP_REFERER']);
                exit(0);
            }
            Model_Core_UrlManager::redirect('grid', null, null, true);
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }
    
    public function deleteAction() {
        try {
            $request = $this->getRequest();
            $customer = new Model_Customer();

            $id = $request->getGet($customer->getPrimaryKey());
            if (!$id) Model_Core_UrlManager::redirect('grid', null, null, true);

            $customer->load($id)->delete();
            Model_Core_UrlManager::redirect('grid', null, null, true);
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }

    public function toggleStatusAction() {
        try {
            $request = $this->getRequest();
            $customer = new Model_Customer();
    
            $id = $request->getGet($customer->getPrimaryKey());
            if (!$id) Model_Core_UrlManager::redirect('grid', null, null, true);
    
            $customer->load($id)->setData(['status' => (1 - $customer->status), 'updatedDate'=>null])->save();
            Model_Core_UrlManager::redirect('grid', null, null, true);    
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }
}