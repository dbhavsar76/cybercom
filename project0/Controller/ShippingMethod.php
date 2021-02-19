<?php
require_once ROOT.'\\Controller\\Core\\Base.php';
require_once ROOT.'\\Block\\Header.php';
require_once ROOT.'\\Block\\Footer.php';

class Controller_ShippingMethod extends Controller_Core_Base {

    public function gridAction() {
        try {
            require_once ROOT.'\\Block\\ShippingMethod\\Grid.php';
            $headerBlock = new Block_Header();
            $gridBlock = new Block_ShippingMethod_Grid();
            $footerBlock = new Block_Footer();

            
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }

    public function addAction() {
        try {
            $req = $this->getRequest();
            $shippingMethod = new Model_ShippingMethod();
        
            $status = ($shippingMethod->status == Model_ShippingMethod::STATUS_DISABLED) ? '' : 'checked';
            $formMode = 'Add';
            $formAction = $this->getUrl('save', null, null, true);
    
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

            if (!$id) $this->redirect('grid', null, null, true);
            
            $shippingMethod->load($id);

            $status = $shippingMethod->status == Model_ShippingMethod::STATUS_DISABLED ? '' : 'checked';
            $formMode = 'Update';
            $formAction = $this->getUrl('save', NULL, ['id'=>$id]);
    
            include ROOT.'\\view\\header.php';
            include ROOT.'\\view\\shippingmethod\\addUpdateForm.php';
            include ROOT.'\\view\\footer.php';
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }

    public function saveAction() {
        try {
            $req = $this->getRequest();
            if (!$req->isPost() || empty($_SERVER['HTTP_REFERER'])) {
                throw new Exception('Invalid Request.');
            }
            $shippingMethod = new Model_ShippingMethod();
            $id = $req->getGet($shippingMethod->getPrimaryKey());

            if ($id) {
                $shippingMethod->{$shippingMethod->getPrimaryKey()} = $id;
            }

            $shippingMethod->setData($req->getPost('shippingMethod', []));
            $shippingMethod->status = $shippingMethod->status ? Model_ShippingMethod::STATUS_ENABLED : Model_ShippingMethod::STATUS_DISABLED;
            $result = $shippingMethod->save();
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
            $shippingMethod = new Model_ShippingMethod();

            $id = $req->getGet($shippingMethod->getPrimaryKey());
            if (!$id) $this->redirect('grid', null, null, true);

            $shippingMethod->load($id)->delete();
            $this->redirect('grid', null, null, true);
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }

    public function toggleStatusAction() {
        try {
            $req = $this->getRequest();
            $shippingMethod = new Model_ShippingMethod();
    
            $id = $req->getGet($shippingMethod->getPrimaryKey());
            if (!$id) $this->redirect('grid', null, null, true);
    
            $shippingMethod->load($id)->setData(['status' => (1 - $shippingMethod->status)])->save();
            $this->redirect('grid', null, null, true);    
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }
}