<?php
// require_once ROOT.'\\Controller\\Core\\Base.php';
// require_once ROOT.'\\Model\\ShippingMethod.php';
// require_once ROOT.'\\Block\\Header.php';
// require_once ROOT.'\\Block\\Footer.php';

class Controller_ShippingMethod extends Controller_Core_Base {

    public function gridAction() {
        try {
            // require_once ROOT.'\\Block\\ShippingMethod\\Grid.php';
            $headerBlock = new Block_Header($this);
            $gridBlock = new Block_ShippingMethod_Grid($this);
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
            // require_once ROOT.'\\Block\\ShippingMethod\\Form.php';

            $headerBlock = new Block_Header($this);
            $formBlock = new Block_ShippingMethod_Form($this);
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
            $req = $this->getRequest();
            $id = $req->getGet((new Model_ShippingMethod)->getPrimaryKey());
            if (!$id) {
                throw new Exception('Invalid Request.');
            }

            // require_once ROOT.'\\Block\\ShippingMethod\\Form.php';

            $headerBlock = new Block_Header($this);
            $formBlock = new Block_ShippingMethod_Form($this, (int)$id);
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