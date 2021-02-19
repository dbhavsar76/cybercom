<?php
require_once ROOT.'\\Controller\\Core\\Base.php';
require_once ROOT.'\\Model\\PaymentMethod.php';

class Controller_PaymentMethod extends Controller_Core_Base {

    public function gridAction() {
        try {
            $paymentMethods = (new Model_PaymentMethod)->load();
    
            include ROOT.'\\view\\header.php';
            include ROOT.'\\view\\paymentmethod\\grid.php';
            include ROOT.'\\view\\footer.php';
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }

    public function addAction() {
        try {
            $req = $this->getRequest();
            $paymentMethod = new Model_PaymentMethod();
        
            $status = ($paymentMethod->status == Model_PaymentMethod::STATUS_DISABLED) ? '' : 'checked';
            $formMode = 'Add';
            $formAction = $this->getUrl('save', null, null, true);

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

            if (!$id) $this->redirect('grid', null, null, true);
            
            $paymentMethod->load($id);

            $status = $paymentMethod->status == Model_PaymentMethod::STATUS_DISABLED ? '' : 'checked';
            $formMode = 'Update';
            $formAction = $this->getUrl('save', NULL, [$paymentMethod->getPrimaryKey() => $id]);
    
            include ROOT.'\\view\\header.php';
            include ROOT.'\\view\\paymentmethod\\addUpdateForm.php';
            include ROOT.'\\view\\footer.php';
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }

    public function saveAction() {
        try {
            $req = $this->getRequest();
            if (!$req->isPost() || empty($_SERVER['HTTP_REFERER'])) {
                throw new Exception("Invalid Request");
            }
            $paymentMethod = new Model_PaymentMethod();
            $id = $req->getGet($paymentMethod->getPrimaryKey());

            if ($id) {
                $paymentMethod->{$paymentMethod->getPrimaryKey()} = $id;
            }

            $paymentMethod->setData($req->getPost('paymentMethod'));
            $paymentMethod->status = $paymentMethod->status ? Model_PaymentMethod::STATUS_ENABLED : Model_PaymentMethod::STATUS_DISABLED;
            $result = $paymentMethod->save();
            if (!$result) {
                header('location:'.$_SERVER['HTTP_REFERER']);
                exit(0);
            }
            $this->redirect('grid', null, null, true);
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }
    
    public function deleteAction() {
        try {
            $req = $this->getRequest();
            $paymentMethod = new Model_PaymentMethod();

            $id = $req->getGet($paymentMethod->getPrimaryKey());
            if (!$id) $this->redirect('grid', null, null, true);

            $paymentMethod->load($id)->delete();
            $this->redirect('grid', null, null, true);
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }

    public function toggleStatusAction() {
        try {
            $req = $this->getRequest();
            $paymentMethod = new Model_PaymentMethod();
    
            $id = $req->getGet($paymentMethod->getPrimaryKey());
            if (!$id) $this->redirect('grid', null, null, true);
    
            $paymentMethod->load($id)->setData(['status' => (1 - $paymentMethod->status)])->save();
            $this->redirect('grid', null, null, true);    
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }
}