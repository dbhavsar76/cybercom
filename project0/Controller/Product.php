<?php
require_once ROOT.'\\Controller\\Core\\Base.php';
require_once ROOT.'\\Model\\Product.php';
require_once ROOT.'\\Block\\Header.php';
require_once ROOT.'\\Block\\Footer.php';

class Controller_Product extends Controller_Core_Base {

    public function gridAction() {
        try {
            require_once ROOT.'\\Block\\Product\\Grid.php';

            $headerBlock = new Block_Header($this);
            $gridBlock = new Block_Product_Grid($this);
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
            require_once ROOT.'\\Block\\Product\\Form.php';

            $headerBlock = new Block_Header($this);
            $formBlock = new Block_Product_Form($this);
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
            $id = $req->getGet((new Model_Product)->getPrimaryKey());
            if (!$id) $this->redirect('grid', null, null, true);
            
            require_once ROOT.'\\Block\\Product\\Form.php';

            $headerBlock = new Block_Header($this);
            $formBlock = new Block_Product_Form($this, (int)$id);
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
            $this->redirect('grid', null, null, true);
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }
    
    public function deleteAction() {
        try {
            $req = $this->getRequest();
            $product = new Model_Product();

            $id = $req->getGet($product->getPrimaryKey());
            if (!$id) $this->redirect('grid', null, null, true);

            $product->load($id)->delete();
            $this->redirect('grid', null, null, true);
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
            $this->redirect('grid', null, null, true);    
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }
}