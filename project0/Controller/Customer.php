<?php
require_once ROOT.'\\Controller\\Core\\Base.php';
require_once ROOT.'\\Model\\Customer.php';

class Controller_Customer extends Controller_Core_Base {

    public function gridAction() {
        try {
            $customers = (new Model_Customer)->load();
    
            include ROOT.'\\view\\header.php';
            include ROOT.'\\view\\customer\\grid.php';
            include ROOT.'\\view\\footer.php';
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }

    public function addAction() {
        try {
            $req = $this->getRequest();
            $customer = new Model_Customer();
        
            $status = ($customer->status == Model_Customer::STATUS_DISABLED) ? '' : 'checked';
            $formMode = 'Add';
            $formAction = $this->getUrl('save', null, null, true);
    
            include ROOT.'\\view\\header.php';
            include ROOT.'\\view\\customer\\addUpdateForm.php';
            include ROOT.'\\view\\footer.php';
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }

    public function updateAction() {
        try {
            $req = $this->getRequest();
            $customer = new Model_Customer();
            $id = $req->getGet($customer->getPrimaryKey());

            if (!$id) $this->redirect('grid', null, null, true);

            $customer->load($id);
                
            $status = ($customer->status == Model_Customer::STATUS_DISABLED) ? '' : 'checked';
            $formMode = 'Update';
            $formAction = $this->getUrl('save', NULL, ['id'=>$id]);
    
            include ROOT.'\\view\\header.php';
            include ROOT.'\\view\\customer\\addUpdateForm.php';
            include ROOT.'\\view\\footer.php';
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
                $customerData['password'] = md5($customerData['password']);
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