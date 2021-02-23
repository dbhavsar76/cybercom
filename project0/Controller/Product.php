<?php

class Controller_Product extends Controller_Core_Base {

    public function gridAction() {
        try {
            $layout = $this->getLayout();
            $layout->prepareChildren(Block_Core_Layout::LAYOUT_ONE_COLUMN);
            $layout->getChild('header')->addChild(new Block_Header);
            $layout->getChild('content')->addChild(new Block_Product_Grid);
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
            $layout->getChild('content')->addChild(new Block_Product_Form);
            $layout->getChild('footer')->addChild(new Block_Footer);

            $layout->render();
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }

    public function editAction() {
        try {
            $id = $this->getRequest()->getGet((new Model_Product)->getPrimaryKey());
            if (!$id) Model_Core_UrlManager::redirect('grid', null, null, true);

            $layout = $this->getLayout();
            $layout->prepareChildren(Block_Core_Layout::LAYOUT_ONE_COLUMN);
            $layout->getChild('header')->addChild(new Block_Header);
            $layout->getChild('content')->addChild(new Block_Product_Form((int)$id));
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
            $product = new Model_Product();
            $id = $req->getGet($product->getPrimaryKey());

            if ($id) {
                $product->{$product->getPrimaryKey()} = $id;
                $product->updatedDate = null;
            }
            $product->setData($req->getPost('product'));
            $product->status = $product->status ? Model_Product::STATUS_ENABLED : Model_Product::STATUS_DISABLED;
            $result = $product->save();
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
            $product = new Model_Product();

            $id = $req->getGet($product->getPrimaryKey());
            if (!$id) Model_Core_UrlManager::redirect('grid', null, null, true);

            $product->load($id)->delete();
            Model_Core_UrlManager::redirect('grid', null, null, true);
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }

    public function toggleStatusAction() {
        try {
            $req = $this->getRequest();
            $product = new Model_Product();
    
            $id = $req->getGet($product->getPrimaryKey());
            if (!$id) throw new Exception('Invalid Request.');
    
            $product->load($id)->setData(['status' => (1 - $product->status), 'updatedDate'=>null])->save();
            Model_Core_UrlManager::redirect('grid', null, null, true);    
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }
}