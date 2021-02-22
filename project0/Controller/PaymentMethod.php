<?php
// require_once ROOT.'\\Controller\\Core\\Base.php';
// require_once ROOT.'\\Model\\PaymentMethod.php';
// require_once ROOT.'\\Block\\Header.php';
// require_once ROOT.'\\Block\\Footer.php';

class Controller_PaymentMethod extends Controller_Core_Base {

    public function gridAction() {
        try {
            // require_once ROOT.'\\Block\\PaymentMethod\\Grid.php';

            $headerBlock = new Block_Header($this);
            $gridBlock = new Block_PaymentMethod_Grid($this);
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
            // require_once ROOT.'\\Block\\PaymentMethod\\Form.php';

            $headerBlock = new Block_Header($this);
            $formBlock = new Block_PaymentMethod_Form($this);
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
            $id = $req->getGet((new Model_PaymentMethod)->getPrimaryKey());
            if (!$id) $this->redirect('grid', null, null, true);

            // require_once ROOT.'\\Block\\PaymentMethod\\Form.php';

            $headerBlock = new Block_Header($this);
            $formBlock = new Block_PaymentMethod_Form($this, (int)$id);
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