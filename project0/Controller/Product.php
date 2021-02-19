<?php
require_once ROOT.'\\Controller\\Core\\Base.php';
require_once ROOT.'\\Model\\Product.php';

class Controller_Product extends Controller_Core_Base {

    public function gridAction() {
        try {
            $products = (new Model_Product)->load();
    
            include ROOT.'\\view\\header.php';
            include ROOT.'\\view\\product\\grid.php';
            include ROOT.'\\view\\footer.php';
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }

    public function addAction() {
        try {
            $req = $this->getRequest();
            $product = new Model_Product();
    
            $status = ($product->status == Model_Product::STATUS_DISABLED) ? '' : 'checked';
            $formMode = 'Add';
            $formAction = $this->getUrl('save', null, null, true);
    
            include ROOT.'\\view\\header.php';
            include ROOT.'\\view\\product\\addUpdateForm.php';
            include ROOT.'\\view\\footer.php';
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }

    public function updateAction() {
        try {
            $req = $this->getRequest();
            $product = new Model_Product();
            $id = $req->getGet($product->getPrimaryKey());

            if (!$id) $this->redirect('grid', null, null, true);
            
            $product->load($id);

            $status = $product->status == Model_Product::STATUS_DISABLED ? '' : 'checked';
            $formMode = 'Update';
            $formAction = $this->getUrl('save', NULL, ['id'=>$id]);
    
            include ROOT.'\\view\\header.php';
            include ROOT.'\\view\\product\\addUpdateForm.php';
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
            $product = new Model_Product();
            $id = $req->getGet($product->getPrimaryKey());

            if ($id) {
                $product->{$product->getPrimaryKey()} = $id;
            }

            $product->setData($req->getPost('product'));
            $product->status = $product->status ? Model_Product::STATUS_ENABLED : Model_Product::STATUS_DISABLED;
            $product->updatedDate = null;
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