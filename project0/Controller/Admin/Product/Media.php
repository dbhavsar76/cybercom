<?php
namespace Controller\Admin\Product;

class Media extends \Controller\Core\Base {
    public function __construct() {
        parent::__construct();
        $this->setMessageService(new \Model\Admin\Message);
    }

    public function gridAction() {
        try {
            $gridHtml = (new \Block\Admin\Product\Media\Grid)->render();
        } catch (\Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
        } finally {
            $response = [
                'status' => 'success',
                'element' => [
                    [
                        'selector' => '#content',
                        'html' => $gridHtml
                    ],
                ]
            ];

            $message = $this->getMessageService()->getMessage();
            if ($message) {
                $response['element'][] = [
                    'selector' => '#message',
                    'html' => (new \Block\Core\Message($message))->render()
                ];
                $this->getMessageService()->clearMessage();
            }

            header("Content-type: application/json; charset=utf-8");
            echo json_encode($response);
        }
    }

    public function uploadAction() {
        try {
            $productId = $this->getRequest()->getGet((new \Model\Product)->getPrimaryKey());
            $image = $_FILES['image'];
            if (!$image || $image['error']) {
                throw new \Exception('Image was not uploaded.');
            }
            $path = ROOT.'/media/product/'. $productId;
            if (!file_exists($path)) {
                mkdir($path);
            }

            $imageModel = new \Model\Product\Media();
            $imageModel->productId = $productId;
            $imageModel->label = pathinfo($image['name'], PATHINFO_FILENAME);
            $imageId = $imageModel->save();
            if (!$imageId) {
                throw new \Exception('Could not upload image.');
            }
            
            $target = $path . '/' . $imageId . '.png';
            if (file_exists($target)) {
                throw new \Exception('File already exists.');
            }
            if (!@move_uploaded_file($image['tmp_name'], $target)) {
                throw new \Exception('Could not save image.');
            }
            $this->getMessageService()->setSuccess('Image uploaded.');
        } catch (\Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
        } finally {
            $this->gridAction();
        }
    }


    public function updateAction() {
        try {
            $request = $this->getRequest();
            $productId = $request->getGet((new \Model\Product)->getPrimaryKey());
            $smallId = $request->getPost('small');
            $thumbId = $request->getPost('thumb');
            $baseId = $request->getPost('base');
            $galleryIds = $request->getPost('gallery', []);

            $updated = (new \Model\Product\Media)->saveStates($productId, $smallId, $thumbId, $baseId, $galleryIds);
            if (!$updated) {
                throw new \Exception("Could not save data. {$productId} {$smallId} {$thumbId} {$baseId}");
            }

            $labels = $request->getPost('label', []);
            foreach ($labels as $id => $label) {
                (new \Model\Product\Media)->setData(['id' => $id, 'label' => $label])->save();
            }


            $this->getMessageService()->setSuccess('Data updated.');
        } catch (\Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
        } finally {
            $this->gridAction();
        }
    }

    public function removeAction() {
        try {
            $productId = $this->getRequest()->getGet((new \Model\Product)->getPrimaryKey());
            $imageIds = $this->getRequest()->getPost('remove');
            if (!$imageIds) {
                $this->getMessageService()->setNotice('Nothing selected.');
                return;
            }
            
            $removed = (new \Model\Product\Media)->remove($imageIds, $productId);
            if (!$removed) {
                throw new \Exception('Could not remove images.');
            }

            foreach ($imageIds as $imageId) {
                $target = ROOT . "/media/product/{$productId}/{$imageId}.png";
                unlink($target);
            }

            $this->getMessageService()->setSuccess('Images removed.');
        } catch (\Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
        } finally {
            $this->gridAction();
        }
    }
}