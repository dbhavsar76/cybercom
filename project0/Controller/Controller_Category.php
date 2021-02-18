<?php
require_once ROOT.'\\Controller\\Core\\Base.php';
require_once ROOT.'\\Model\\Model_Category.php';

class Controller_Category extends Base {

    public function listAction() {
        
        $categories = (new Model_Category)->load();

        include ROOT.'\\view\\header.php';
        include ROOT.'\\view\\category\\list.php';
        include ROOT.'\\view\\footer.php';
    }

    public function addAction() {
        try {
            $req = $this->getRequest();
            $category = new Model_Category();

            if ($req->isPost()) {
                $category->setData($req->getPost('category', []));
                $category->status = $category->status ? 1 : 0;
                $result = $category->save();
                if ($result) $this->redirect('list', null, null, true);
            }

            $status = ($category->status === 0) ? '' : 'checked';
            $formMode = 'Add';
            $formAction = $this->getUrl('add', null, null, true);

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

            if (!$id) $this->redirect('list', null, null, true);
            
            $category->load($id);

            if ($req->isPost()) {
                $category->setData($req->getPost('category'));
                $category->status = $category->status ? 1 : 0;
                
                $result = $category->save();
                if ($result) $this->redirect('list', null, null, true);
            }

            $status = $category->status === 0 ? '' : 'checked';    
            $formMode = 'Update';
            $formAction = $this->getUrl('update', null, ['id'=>$id]);
    
            include ROOT.'\\view\\header.php';
            include ROOT.'\\view\\category\\addUpdateForm.php';
            include ROOT.'\\view\\footer.php';
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }
    
    public function deleteAction() {
        try {
            $req = $this->getRequest();
            $category = new Model_Category();

            $id = $req->getGet($category->getPrimaryKey());
            if (!$id) $this->redirect('list', null, null, true);

            $category->load($id)->delete();
            $this->redirect('list', null, null, true);
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }

    public function toggleStatusAction() {
        try {
            $req = $this->getRequest();
            $category = new Model_Category();
    
            $id = $req->getGet($category->getPrimaryKey());
            if (!$id) $this->redirect('list');
    
            $category->load($id)->setData(['status' => (1 - $category->status)])->save();
            $this->redirect('list', null, null, true);    
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }
}