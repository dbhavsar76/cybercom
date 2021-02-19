<?php
require_once ROOT.'\\Controller\\Core\\Base.php';
require_once ROOT.'\\Model\\Category.php';

class Controller_Category extends Controller_Core_Base {

    public function gridAction() {
        
        $categories = (new Model_Category)->load();

        include ROOT.'\\view\\header.php';
        include ROOT.'\\view\\category\\grid.php';
        include ROOT.'\\view\\footer.php';
    }

    public function addAction() {
        try {
            $req = $this->getRequest();
            $category = new Model_Category();

            $status = 'checked';
            $formMode = 'Add';
            $formAction = $this->getUrl('save', null, null, true);

            include ROOT.'\\view\\header.php';
            include ROOT.'\\view\\category\\addUpdateForm.php';
            include ROOT.'\\view\\footer.php';
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }

    public function updateAction() {
        try {
            $req = $this->getRequest();
            $category = new Model_Category();
            $id = $req->getGet($category->getPrimaryKey());

            if (!$id) $this->redirect('grid', null, null, true);

            $category->load($id);

            $status = $category->status == Model_Category::STATUS_DISABLED ? '' : 'checked';    
            $formMode = 'Update';
            $formAction = $this->getUrl('save', null, ['id'=>$id]);
    
            include ROOT.'\\view\\header.php';
            include ROOT.'\\view\\category\\addUpdateForm.php';
            include ROOT.'\\view\\footer.php';
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }

    public function saveAction() {
        try {
            $req = $this->getRequest();
            if (!$req->isPost() || empty($_SERVER['HTTP_REFERER'])) {
                throw new Exception("Invalid Request.");
            }
            $category = new Model_Category();
            $id = $req->getGet($category->getPrimaryKey());
            if ($id) $category->{$category->getPrimaryKey()} = $id;

            $category->setData($req->getPost('category', []));
            $category->status = $category->status ? Model_Category::STATUS_ENABLED : Model_Category::STATUS_DISABLED;
            
            $result = $category->save();
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
            $category = new Model_Category();

            $id = $req->getGet($category->getPrimaryKey());
            if (!$id) $this->redirect('grid', null, null, true);

            $category->load($id)->delete();
            $this->redirect('grid', null, null, true);
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }

    public function toggleStatusAction() {
        try {
            $req = $this->getRequest();
            $category = new Model_Category();
    
            $id = $req->getGet($category->getPrimaryKey());
            if (!$id) $this->redirect('grid');
    
            $category->load($id)->setData(['status' => (1 - $category->status)])->save();
            $this->redirect('grid', null, null, true);    
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }
}