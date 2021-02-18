<?php
require_once ROOT.'\\Controller\\Core\\Base.php';
require_once ROOT.'\\Model\\Model_Product.php';

class Controller_Product extends Base {

    public function listAction() {
        try {
            $products = (new Model_Product)->load();
    
            include ROOT.'\\view\\header.php';
            include ROOT.'\\view\\product\\list.php';
            include ROOT.'\\view\\footer.php';
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }

    public function addAction() {
        try {
            $req = $this->getRequest();
            $product = new Model_Product();
    
            if ($req->isPost()) {
                $product->setData($req->getPost('product', []));
                $product->status = $product->status ? 1 : 0;
                $result = $product->save();
                if ($result) $this->redirect('list', null, null, true);
            }
    
            $status = ($product->status === 0) ? '' : 'checked';
            $formMode = 'Add';
            $formAction = $this->getUrl('add', null, null, true);
    
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

            if (!$id) $this->redirect('list', null, null, true);
            
            $product->load($id);

            if ($req->isPost()) {
                $product->setData($req->getPost('product'));
                $product->status = $product->status ? 1 : 0;
                $product->updatedDate = null;
                $result = $product->save();
                if ($result) $this->redirect('list', null, null, true);
            }

            $status = $product->status === 0 ? '' : 'checked';    
            $formMode = 'Update';
            $formAction = $this->getUrl('update', NULL, ['id'=>$id]);
    
            include ROOT.'\\view\\header.php';
            include ROOT.'\\view\\product\\addUpdateForm.php';
            include ROOT.'\\view\\footer.php';
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }
    
    public function deleteAction() {
        try {
            $req = $this->getRequest();
            $product = new Model_Product();

            $id = $req->getGet($product->getPrimaryKey());
            if (!$id) $this->redirect('list', null, null, true);

            $product->load($id)->delete();
            $this->redirect('list', null, null, true);
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }

    public function toggleStatusAction() {
        try {
            $req = $this->getRequest();
            $product = new Model_Product();
    
            $id = $req->getGet($product->getPrimaryKey());
            if (!$id) $this->redirect('list', null, null, true);
    
            $product->load($id)->setData(['status' => (1 - $product->status), 'updatedDate'=>null])->save();
            $this->redirect('list', null, null, true);    
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }
}