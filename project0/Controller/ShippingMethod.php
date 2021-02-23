<?php

class Controller_ShippingMethod extends Controller_Core_Base {

    public function gridAction() {
        try {
            $layout = $this->getLayout();
            $layout->prepareChildren(Block_Core_Layout::LAYOUT_ONE_COLUMN);
            $layout->getChild('header')->addChild(new Block_Header);
            $layout->getChild('content')->addChild(new Block_ShippingMethod_Grid);
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
            $layout->getChild('content')->addChild(new Block_ShippingMethod_Form);
            $layout->getChild('footer')->addChild(new Block_Footer);

            $layout->render();
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }

    public function editAction() {
        try {
            $id = $this->getRequest()->getGet((new Model_ShippingMethod)->getPrimaryKey());
            if (!$id) {
                throw new Exception('Invalid Request.');
            }

            $layout = $this->getLayout();
            $layout->prepareChildren(Block_Core_Layout::LAYOUT_ONE_COLUMN);
            $layout->getChild('header')->addChild(new Block_Header);
            $layout->getChild('content')->addChild(new Block_ShippingMethod_Form((int)$id));
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
            Model_Core_UrlManager::redirect('grid', null, null, true);
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }
    
    public function deleteAction() {
        try {
            $req = $this->getRequest();
            $shippingMethod = new Model_ShippingMethod();

            $id = $req->getGet($shippingMethod->getPrimaryKey());
            if (!$id) Model_Core_UrlManager::redirect('grid', null, null, true);

            $shippingMethod->load($id)->delete();
            Model_Core_UrlManager::redirect('grid', null, null, true);
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }

    public function toggleStatusAction() {
        try {
            $req = $this->getRequest();
            $shippingMethod = new Model_ShippingMethod();
    
            $id = $req->getGet($shippingMethod->getPrimaryKey());
            if (!$id) Model_Core_UrlManager::redirect('grid', null, null, true);
    
            $shippingMethod->load($id)->setData(['status' => (1 - $shippingMethod->status)])->save();
            Model_Core_UrlManager::redirect('grid', null, null, true);    
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }
}