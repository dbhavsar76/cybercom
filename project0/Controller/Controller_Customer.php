<?php
require_once ROOT.'\\Controller\\Core\\Base.php';
require_once ROOT.'\\Model\\Model_Customer.php';

class Controller_Customer extends Base {

    public function listAction() {
        try {
            $customers = (new Model_Customer)->load();
    
            include ROOT.'\\view\\header.php';
            include ROOT.'\\view\\customer\\list.php';
            include ROOT.'\\view\\footer.php';
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }

    public function addAction() {
        try {
            $req = $this->getRequest();
            $customer = new Model_Customer();
    
            if ($req->isPost()) {
                $customerData = $req->getPost('customer', []);
                unset($customerData['password2']); // after validation remove confirm password value
                $customer->setData($customerData);
                $customer->status = $customer->status ? 1 : 0;
                $customer->password = md5($customer->password);
                $result = $customer->save();
                if ($result) $this->redirect('list', null, null, true);
            }
    
            $status = ($customer->status === 0) ? '' : 'checked';
            $formMode = 'Add';
            $formAction = $this->getUrl('add', null, null, true);
    
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

            if (!$id) $this->redirect('list', null, null, true);

            $customer->load($id);
            
            if ($req->isPost()) {
                $customerData = $req->getPost('customer');
                if (array_key_exists('password2', $customerData)) unset($customerData['password2']);
                $customer->setData($customerData);
                $result = $customer->save();
                if ($result) $this->redirect('list');
            }
    
            $formMode = 'Update';
            $formAction = $this->getUrl('update', NULL, ['id'=>$id]);
    
            include ROOT.'\\view\\header.php';
            include ROOT.'\\view\\customer\\addUpdateForm.php';
            include ROOT.'\\view\\footer.php';
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }
    
    public function deleteAction() {
        try {
            $req = $this->getRequest();
            $customer = new Model_Customer();

            $id = $req->getGet($customer->getPrimaryKey());
            if (!$id) $this->redirect('list', null, null, true);

            $customer->load($id)->delete();
            $this->redirect('list', null, null, true);
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }

    public function toggleStatusAction() {
        try {
            $req = $this->getRequest();
            $customer = new Model_Customer();
    
            $id = $req->getGet($customer->getPrimaryKey());
            if (!$id) $this->redirect('list', null, null, true);
    
            $customer->load($id)->setData(['status' => (1 - $customer->status), 'updatedDate'=>null])->save();
            $this->redirect('list', null, null, true);    
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }
}