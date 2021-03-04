<?php

class Controller_Product_Media extends Controller_Core_Base {
    public function __construct() {
        parent::__construct();
        $this->setMessageService(new Model_Admin_Message);
    }

    public function gridAction() {
        try {
            $gridHtml = (new Block_Product_Media_Grid)->render();
        } catch (Exception $e) {
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
                    'html' => (new Block_Core_Message($message))->render()
                ];
                $this->getMessageService()->clearMessage();
            }

            header("Content-type: application/json; charset=utf-8");
            echo json_encode($response);
        }
    }

    public function uploadAction() {
        try {
            $request = new Model_Core_Request;
            $id = $request->getGet((new Model_Product)->getPrimaryKey());
            $image = $_FILES['image'];
            if (!$image || $image['error']) {
                throw new Exception('Image was not uploaded.');
            }
            $path = ROOT.'/media/product/'. $id;
            if (!file_exists($path)) {
                mkdir($path);
            }
            $target = $path . '/' . pathinfo($image['name'], PATHINFO_BASENAME);
            if (file_exists($target)) {
                throw new Exception('File already exists.');
            }
            if (!@move_uploaded_file($image['tmp_name'], $target)) {
                throw new Exception('Could not save image.');
            }
            $this->getMessageService()->setSuccess('Image uploaded.');
        } catch (Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
        } finally {
            $this->gridAction();
        }
    }

    public function deleteAction() {
        try {
            $request = new Model_Core_Request;
            $target = ROOT . '/media/product/' . $request->getGet((new Model_Product)->getPrimaryKey()) . '/' . $request->getGet('imageName');
            if (!unlink($target)) {
                throw new Exception('There was a problem deleting the image.');
            }
            $this->getMessageService()->setSuccess('Image deleted successfully.');
        } catch (Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
        } finally {
            $this->gridAction();
        }
    }

}