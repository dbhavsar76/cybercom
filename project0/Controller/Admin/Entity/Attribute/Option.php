<?php
namespace Controller\Admin\Entity\Attribute;

use Model\Entity\Attribute\Option as AttributeOption;

class Option extends \Controller\Core\Admin {

    public function gridAction() {
        try {
            $attributePrimaryKey = (new \Model\Entity\Attribute)->getPrimaryKey();
            $id = $this->getRequest()->getGet($attributePrimaryKey);
            if (!$id) {
                throw new \Exception('Id not found.');
            }

            $gridHtml = (new \Block\Admin\Entity\Attribute\Option\Grid($id))->render();
        } catch (\Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
        }
        
        $response = $this->getResponse();
        $response->setStatus('success');
        $response->addElement('#content', $gridHtml);

        $message = $this->getMessageService()->getMessage();
        if ($message) {
            $messageHtml = (new \Block\Core\Message($message))->render();
            $response->addElement('#message', $messageHtml);
            $this->getMessageService()->clearMessage();
        }

        $response->send();
    }

    public function updateAction() {
        try {
            $attributePrimaryKey = (new \Model\Entity\Attribute)->getPrimaryKey();
            $id = $this->getRequest()->getGet($attributePrimaryKey);
            if (!$id) {
                throw new \Exception('Id not Found.');
            }

            $option = new AttributeOption;
            $optionsData = $this->getRequest()->getPost('options');
            foreach ($optionsData['existing'] ?? [] as $optionId => $optionData) {
                $option->resetData()->setData([$option->getPrimaryKey() => $optionId] + $optionData)->save();
            }
            
            $option->insertMultiple($id, $optionsData['new'] ?? []);
            $option->removeMultiple($optionsData['remove']);
            $this->getMessageService()->setSuccess('Data Updated.');
        } catch (\Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
        } finally {
            $this->gridAction();
        }
    }
}