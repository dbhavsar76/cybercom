<?php
// require_once ROOT.'\\Controller\\Core\\Base.php';
// require_once ROOT.'\\Model\\Category.php';
// require_once ROOT.'\\Block\\Header.php';
// require_once ROOT.'\\Block\\Footer.php';

class Controller_Category extends Controller_Core_Base {

    public function gridAction() {
        // require_once ROOT.'\\Block\\Category\\Grid.php';
        
        $headerBlock = new Block_Header($this);
        $gridBlock = new Block_Category_Grid($this);
        $footerBlock = new Block_Footer($this);

        $headerBlock->render();
        $gridBlock->render();
        $footerBlock->render();

    }

    public function addAction() {
        try {
            // require_once ROOT.'\\Block\\Category\\Form.php';
        
            $headerBlock = new Block_Header($this);
            $formBlock = new Block_Category_Form($this);
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
            $id = $req->getGet((new Model_Category)->getPrimaryKey());
            if (!$id) $this->redirect('grid', null, null, true);

            // require_once ROOT.'\\Block\\Category\\Form.php';
        
            $headerBlock = new Block_Header($this);
            $formBlock = new Block_Category_Form($this, (int)$id);
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