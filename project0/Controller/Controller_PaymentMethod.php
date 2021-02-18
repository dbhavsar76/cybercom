<?php
require_once ROOT.'\\Controller\\Core\\Base.php';
require_once ROOT.'\\Model\\Model_PaymentMethod.php';

class Controller_PaymentMethod extends Base {

    public function listAction() {
        try {
            $paymentMethods = (new Model_PaymentMethod)->load();
    
            include ROOT.'\\view\\header.php';
            include ROOT.'\\view\\paymentmethod\\list.php';
            include ROOT.'\\view\\footer.php';
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }

    public function addAction() {
        try {
            $req = $this->getRequest();
            $paymentMethod = new Model_PaymentMethod();
    
            if ($req->isPost()) {
                $paymentMethod->setData($req->getPost('paymentMethod', []));
                $paymentMethod->status = $paymentMethod->status ? 1 : 0;
                $result = $paymentMethod->save();
                if ($result) $this->redirect('list', null, null, true);
            }
    
            $status = ($paymentMethod->status == '0') ? '' : 'checked';
            $formMode = 'Add';
            $formAction = $this->getUrl('add', null, null, true);
    
            include ROOT.'\\view\\header.php';
            include ROOT.'\\view\\paymentmethod\\addUpdateForm.php';
            include ROOT.'\\view\\footer.php';
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }

    public function updateAction() {
        try {
            $req = $this->getRequest();
            $paymentMethod = new Model_PaymentMethod();
            $id = $req->getGet($paymentMethod->getPrimaryKey());

            if (!$id) $this->redirect('list', null, null, true);
            
            $paymentMethod->load($id);

            if ($req->isPost()) {
                $paymentMethod->setData($req->getPost('paymentMethod'));
                $paymentMethod->status = $paymentMethod->status ? 1 : 0;
                $result = $paymentMethod->save();
                if ($result) $this->redirect('list', null, null, true);
            }

            $status = $paymentMethod->status === 0 ? '' : 'checked';    
            $formMode = 'Update';
            $formAction = $this->getUrl('update', NULL, [$paymentMethod->getPrimaryKey() => $id]);
    
            include ROOT.'\\view\\header.php';
            include ROOT.'\\view\\paymentmethod\\addUpdateForm.php';
            include ROOT.'\\view\\footer.php';
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }
    
    public function deleteAction() {
        try {
            $req = $this->getRequest();
            $paymentMethod = new Model_PaymentMethod();

            $id = $req->getGet($paymentMethod->getPrimaryKey());
            if (!$id) $this->redirect('list', null, null, true);

            $paymentMethod->load($id)->delete();
            $this->redirect('list', null, null, true);
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }

    public function toggleStatusAction() {
        try {
            $req = $this->getRequest();
            $paymentMethod = new Model_PaymentMethod();
    
            $id = $req->getGet($paymentMethod->getPrimaryKey());
            if (!$id) $this->redirect('list', null, null, true);
    
            $paymentMethod->load($id)->setData(['status' => (1 - $paymentMethod->status)])->save();
            $this->redirect('list', null, null, true);    
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }
}