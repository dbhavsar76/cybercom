<?php
require_once ROOT.'\\Controller\\Core\\Base.php';
require_once ROOT.'\\Model\\Customer.php';
require_once ROOT.'\\Block\\Header.php';
require_once ROOT.'\\Block\\Footer.php';

class Controller_Customer extends Controller_Core_Base {

    public function gridAction() {
        try {
            require_once ROOT.'\\Block\\Customer\\Grid.php';

            $headerBlock = new Block_Header($this);
            $gridBlock = new Block_Customer_Grid($this);
            $footerBlock = new Block_Footer($this);

            $headerBlock->render();
            $gridBlock->render();
            $footerBlock->render();

        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }

    public function addAction() {
        try {
            require_once ROOT.'\\Block\\Customer\\Form.php';

            $headerBlock = new Block_Header($this);
            $formBlock = new Block_Customer_Form($this);
            $footerBlock = new Block_Footer($this);

            $headerBlock->render();
            $formBlock->render();
            $footerBlock->render();

        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }

    public function editAction() {
        try {
            $id = $this->getRequest()->getGet((new Model_Customer)->getPrimaryKey());
            if (!$id) $this->redirect('grid', null, null, true);

            require_once ROOT.'\\Block\\Customer\\Form.php';

            $headerBlock = new Block_Header($this);
            $formBlock = new Block_Customer_Form($this, (int)$id);
            $footerBlock = new Block_Footer($this);

            $headerBlock->render();
            $formBlock->render();
            $footerBlock->render();

        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }

    public function saveAction() {
        try {
            $req = $this->getRequest();
            if (!$req->isPost() || empty($_SERVER['HTTP_REFERER'])) {
                throw new Exception("Invalid Request.");
            }
            $customer = new Model_Customer();
            $id = $req->getGet($customer->getPrimaryKey());
            if ($id) $customer->{$customer->getPrimaryKey()} = $id;

            $customerData = $req->getPost('customer',[]);
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
            $this->redirect('grid');
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }
    
    public function deleteAction() {
        try {
            $req = $this->getRequest();
            $customer = new Model_Customer();

            $id = $req->getGet($customer->getPrimaryKey());
            if (!$id) $this->redirect('grid', null, null, true);

            $customer->load($id)->delete();
            $this->redirect('grid', null, null, true);
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }

    public function toggleStatusAction() {
        try {
            $req = $this->getRequest();
            $customer = new Model_Customer();
    
            $id = $req->getGet($customer->getPrimaryKey());
            if (!$id) $this->redirect('grid', null, null, true);
    
            $customer->load($id)->setData(['status' => (1 - $customer->status), 'updatedDate'=>null])->save();
            $this->redirect('grid', null, null, true);    
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }
}