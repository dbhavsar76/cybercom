<?php

class Controller_Category extends Controller_Core_Base {

    public function gridAction() {
        try {
            $layout = $this->getLayout();
            $layout->prepareChildren(Block_Core_Layout::LAYOUT_ONE_COLUMN);
            $layout->getChild('header')->addChild(new Block_Header);
            $layout->getChild('content')->addChild(new Block_Category_Grid);
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
            $layout->getChild('content')->addChild(new Block_Category_Form);
            $layout->getChild('footer')->addChild(new Block_Footer);

            $layout->render();
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }

    public function editAction() {
        try {
            $id = $this->getRequest()->getGet((new Model_Category)->getPrimaryKey());
            if (!$id) Model_Core_UrlManager::redirect('grid', null, null, true);
        
            $layout = $this->getLayout();
            $layout->prepareChildren(Block_Core_Layout::LAYOUT_ONE_COLUMN);
            $layout->getChild('header')->addChild(new Block_Header);
            $layout->getChild('content')->addChild(new Block_Category_Form((int)$id));
            $layout->getChild('footer')->addChild(new Block_Footer);

            $layout->render();
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }

    public function saveAction() {
        try {
            $request = $this->getRequest();
            if (!$request->isPost() || empty($_SERVER['HTTP_REFERER'])) {
                throw new Exception("Invalid Request.");
            }
            $category = new Model_Category();
            $id = $request->getGet($category->getPrimaryKey());
            if ($id) $category->{$category->getPrimaryKey()} = $id;

            $category->setData($request->getPost('category', []));
            $category->status = $category->status ? Model_Category::STATUS_ENABLED : Model_Category::STATUS_DISABLED;
            
            $result = $category->save();
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
            $request = $this->getRequest();
            $category = new Model_Category();

            $id = $request->getGet($category->getPrimaryKey());
            if (!$id) Model_Core_UrlManager::redirect('grid', null, null, true);

            $category->load($id)->delete();
            Model_Core_UrlManager::redirect('grid', null, null, true);
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }

    public function toggleStatusAction() {
        try {
            $req = $this->getRequest();
            $category = new Model_Category();
    
            $id = $req->getGet($category->getPrimaryKey());
            if (!$id) Model_Core_UrlManager::redirect('grid');
    
            $category->load($id)->setData(['status' => (1 - $category->status)])->save();
            Model_Core_UrlManager::redirect('grid', null, null, true);    
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }
}