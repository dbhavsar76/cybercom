<?php
namespace Controller\Admin;

use Block\Core\{Message, Layout};

class Product extends \Controller\Core\Admin {

    public function gridAction() {
        try {
            $gridHtml = (new \Block\Admin\Product\Grid)->render();
        } catch (\Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
        } 
        
        $response = $this->getResponse();
        $response->setStatus('success');
        $response->setLayout(Layout::LAYOUT_ONE_COLUMN);
        $response->addElement('#content', $gridHtml);

        $message = $this->getMessageService()->getMessage();
        if ($message) {
            $messageHtml = (new Message($message))->render();
            $response->addElement('#message', $messageHtml);
            $this->getMessageService()->clearMessage();
        }

        $response->send();
    }

    public function addAction() {
        try {
            $tabsHtml = (new \Block\Admin\Product\Edit\Tabs(true))->render();
        } catch (\Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
        }

        $response = $this->getResponse();
        $response->setStatus('success');
        $response->setLayout(Layout::LAYOUT_TWO_COLUMNS_WITH_LEFT_SIDEBAR);
        $response->addElement('#left', $tabsHtml);
        $message = $this->getMessageService()->getMessage();
        if ($message) {
            $messageHtml = (new Message($message))->render();
            $response->addElement('#message', $messageHtml);
            $this->getMessageService()->clearMessage();
        }

        $response->send();
    }

    public function editAction() {
        try {
            $id = $this->getRequest()->getGet((new \Model\Product)->getPrimaryKey());
            if (!$id) {
                throw new \Exception('Invalid Action. Id not found.');
            }

            $tabsHtml = (new \Block\Admin\Product\Edit\Tabs)->render();
        } catch (\Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
        }
        
        $response = $this->getResponse();
        $response->setStatus('success');
        
        if ($tabsHtml) {
            $response->setLayout(Layout::LAYOUT_TWO_COLUMNS_WITH_LEFT_SIDEBAR);
            $response->addElement('#left', $tabsHtml);
        }
        
        $message = $this->getMessageService()->getMessage();
        if ($message) {
            $messageHtml = (new Message($message))->render();
            $response->addElement('#message', $messageHtml);
            $this->getMessageService()->clearMessage();
        }

        $response->send();
    }

    public function tabAction() {
        try {
            $id = $this->getRequest()->getGet((new \Model\Product)->getPrimaryKey());

            $formHtml = (new \Block\Admin\Product\Edit((int)$id))->render();
        } catch (\Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
        }
        
        $response = $this->getResponse();
        $response->setStatus('success');
        $response->addElement('#content', $formHtml);

        $message = $this->getMessageService()->getMessage();
        if ($message) {
            $messageHtml = (new Message($message))->render();
            $response->addElement('#message', $messageHtml);
            $this->getMessageService()->clearMessage();
        }

        $response->send();
    }

    public function saveAction() {
        try {
            $req = $this->getRequest();
            if (!$req->isPost() || empty($_SERVER['HTTP_REFERER'])) {
                throw new \Exception('Invalid Request.');
            }
            $product = new \Model\Product();
            $pPrimaryKey = $product->getPrimaryKey();
            $id = $req->getGet($pPrimaryKey);
            if ($id) {
                $product->$pPrimaryKey = $id;
                $product->updatedDate = null;
            }

            $tab = strtolower($req->getGet('tab', \Block\Admin\Product\Edit\Tabs::getDefaultTab()));
            if (!$tab) {
                throw new \Exception('Something went wrong. Could not save data.');
            } else if ($tab == 'information') {
                $product->setData($req->getPost('product'));
                $product->status = $product->status ? \Model\Product::STATUS_ENABLED : \Model\Product::STATUS_DISABLED;
                $result = $product->save();
                if (!$result) {
                    throw new \Exception('Something went wrong. Could not save data.');
                }
                $this->getMessageService()->setSuccess('Data saved successfully.');
            } else if ($tab == 'groupprice') {
                $groupPrice = new \Model\Product\Group\Price;
                $groupPricesArray = $req->getPost('groupPrices');
                foreach ($groupPricesArray['existing'] ?? [] as $eId => $price) {
                    $groupPrice->resetData()->setData([$groupPrice->getPrimaryKey() => $eId, 'price' => $price])->save();
                }
                $groupPrice->insertMultiple($id, $groupPricesArray['new'] ?? []);
                $this->getMessageService()->setSuccess('Data saved successfully.');
            } else if ($tab == 'category') {
                $productCategories = $req->getPost('productCategories', []);
                $result = $product->updateCategories($productCategories);
                if (!$result) {
                    throw new \Exception('Something went wrong. Could not save data.');
                }
                $this->getMessageService()->setSuccess('Data saved successfully.');
            }
            $product->save();
        } catch (\Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
        } finally {
            $this->gridAction();
        }
    }
    
    public function deleteAction() {
        try {
            $product = new \Model\Product();

            $id = $this->getRequest()->getGet($product->getPrimaryKey());
            if (!$id) {
                throw new \Exception('Invalid Action. Id not found.');
            }
            if (!$product->load($id)) {
                throw new \Exception('Could not load data.');
            }
            if (!$product->delete()) {
                throw new \Exception('Could not delete record.');
            }
            $this->getMessageService()->setSuccess('Record deleted successfully.');
            $this->rrmdir(ROOT."/media/product/{$id}");
        } catch (\Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
        } finally {
            $this->gridAction();
        }
    }

    public function toggleStatusAction() {
        try {
            $product = new \Model\Product();
    
            $id = $this->getRequest()->getGet($product->getPrimaryKey());
            if (!$id) {
                throw new \Exception('Invalid Action. Could not find ID.');
            }
            if (!$product->load($id)) {
                throw new \Exception('Could not load data.');
            }
            $result = $product->setData(['status' => (1 - $product->status), 'updatedDate' => null])->save();
            if (!$result) {
                throw new \Exception('Something went wrong. Could not save data.');
            }
            $this->getMessageService()->setSuccess('Status changed successfully.');
        } catch (\Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
        } finally {
            $this->gridAction();
        }
    }

    private function rrmdir($source, $removeOnlyChildren = false)
    {
        if(empty($source) || file_exists($source) === false) {
            return false;
        }
    
        if(is_file($source) || is_link($source)) {
            return unlink($source);
        }
    
        $files = new \RecursiveIteratorIterator (
            new \RecursiveDirectoryIterator($source, \RecursiveDirectoryIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::CHILD_FIRST
        );
    
        //$fileinfo as SplFileInfo
        foreach($files as $fileinfo) {
            if($fileinfo->isDir()) {
                if($this->rrmdir($fileinfo->getRealPath()) === false) {
                    return false;
                }
            }
            else {
                if(unlink($fileinfo->getRealPath()) === false) {
                    return false;
                }
            }
        }
    
        if($removeOnlyChildren === false) {
            return rmdir($source);
        }
    
        return true;
    }
}