<?php

class Controller_PaymentMethod extends Controller_Core_Base {

    public function gridAction() {
        try {
            $layout = $this->getLayout();
            $layout->prepareChildren(Block_Core_Layout::LAYOUT_ONE_COLUMN);
            $layout->getChild('header')->addChild(new Block_Header);
            $layout->getChild('content')->addChild(new Block_PaymentMethod_Grid);
            $layout->getChild('footer')->addChild(new Block_Footer);

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
            $layout->getChild('content')->addChild(new Block_PaymentMethod_Form);
            $layout->getChild('footer')->addChild(new Block_Footer);

            $layout->render();
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }

    public function editAction() {
        try {
            $id = $this->getRequest()->getGet((new Model_PaymentMethod)->getPrimaryKey());
            if (!$id) Model_Core_UrlManager::redirect('grid', null, null, true);

            $layout = $this->getLayout();
            $layout->prepareChildren(Block_Core_Layout::LAYOUT_ONE_COLUMN);
            $layout->getChild('header')->addChild(new Block_Header);
            $layout->getChild('content')->addChild(new Block_PaymentMethod_Form((int)$id));
            $layout->getChild('footer')->addChild(new Block_Footer);

            $layout->render();
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
            Model_Core_UrlManager::redirect('grid', null, null, true);
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }
    
    public function deleteAction() {
        try {
            $req = $this->getRequest();
            $paymentMethod = new Model_PaymentMethod();

            $id = $req->getGet($paymentMethod->getPrimaryKey());
            if (!$id) Model_Core_UrlManager::redirect('grid', null, null, true);

            $paymentMethod->load($id)->delete();
            Model_Core_UrlManager::redirect('grid', null, null, true);
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }

    public function toggleStatusAction() {
        try {
            $req = $this->getRequest();
            $paymentMethod = new Model_PaymentMethod();
    
            $id = $req->getGet($paymentMethod->getPrimaryKey());
            if (!$id) Model_Core_UrlManager::redirect('grid', null, null, true);
    
            $paymentMethod->load($id)->setData(['status' => (1 - $paymentMethod->status)])->save();
            Model_Core_UrlManager::redirect('grid', null, null, true);    
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }
}