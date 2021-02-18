<?php
require_once ROOT.'\\Controller\\Core\\Base.php';
require_once ROOT.'\\Model\\Model_ShippingMethod.php';

class Controller_ShippingMethod extends Base {

    public function listAction() {
        try {
            $shippingMethods = (new Model_ShippingMethod)->load();
    
            include ROOT.'\\view\\header.php';
            include ROOT.'\\view\\shippingmethod\\list.php';
            include ROOT.'\\view\\footer.php';
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }

    public function addAction() {
        try {
            $req = $this->getRequest();
            $shippingMethod = new Model_ShippingMethod();
    
            if ($req->isPost()) {
                $shippingMethod->setData($req->getPost('shippingMethod', []));
                $shippingMethod->status = $shippingMethod->status ? 1 : 0;
                $result = $shippingMethod->save();
                if ($result) $this->redirect('list', null, null, true);
            }
    
            $status = ($shippingMethod->status == '0') ? '' : 'checked';
            $formMode = 'Add';
            $formAction = $this->getUrl('add', null, null, true);
    
            include ROOT.'\\view\\header.php';
            include ROOT.'\\view\\shippingmethod\\addUpdateForm.php';
            include ROOT.'\\view\\footer.php';
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }

    public function updateAction() {
        try {
            $req = $this->getRequest();
            $shippingMethod = new Model_ShippingMethod();
            $id = $req->getGet($shippingMethod->getPrimaryKey());

            if (!$id) $this->redirect('list', null, null, true);
            
            $shippingMethod->load($id);

            if ($req->isPost()) {
                $shippingMethod->setData($req->getPost('paymentMethod'));
                $shippingMethod->status = $shippingMethod->status ? 1 : 0;
                $result = $shippingMethod->save();
                if ($result) $this->redirect('list', null, null, true);
            }

            $status = $shippingMethod->status === 0 ? '' : 'checked';    
            $formMode = 'Update';
            $formAction = $this->getUrl('update', NULL, ['id'=>$id]);
    
            include ROOT.'\\view\\header.php';
            include ROOT.'\\view\\shippingmethod\\addUpdateForm.php';
            include ROOT.'\\view\\footer.php';
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }
    
    public function deleteAction() {
        try {
            $req = $this->getRequest();
            $shippingMethod = new Model_ShippingMethod();

            $id = $req->getGet($shippingMethod->getPrimaryKey());
            if (!$id) $this->redirect('list', null, null, true);

            $shippingMethod->load($id)->delete();
            $this->redirect('list', null, null, true);
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }

    public function toggleStatusAction() {
        try {
            $req = $this->getRequest();
            $shippingMethod = new Model_ShippingMethod();
    
            $id = $req->getGet($shippingMethod->getPrimaryKey());
            if (!$id) $this->redirect('list', null, null, true);
    
            $shippingMethod->load($id)->setData(['status' => (1 - $shippingMethod->status)])->save();
            $this->redirect('list', null, null, true);    
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }
}