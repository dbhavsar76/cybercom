<?php
namespace Block\Core\Edit;

use Model\Entity\Attribute;

class Input extends \Block\Core\Template {
    protected $attribute = null;
    protected $entity = null;
    
    public function __construct($attribute) {
        parent::__construct();
        $this->setAttribute($attribute);
        $this->setType($attribute->inputTypeId);
    }

    public function setType($type) {
        switch ($type) {
            case Attribute::INPUT_TYPE_CHECKBOX:
                $this->setTemplate('/core/edit/input/checkbox.php');
                break;

            case Attribute::INPUT_TYPE_RADIO:
                $this->setTemplate('/core/edit/input/radio.php');
                break;

            case Attribute::INPUT_TYPE_SELECT:
                $this->setTemplate('/core/edit/input/select.php');
                break;

            case Attribute::INPUT_TYPE_SELECT_MULTIPLE:
                $this->setTemplate('/core/edit/input/select_multiple.php');
                break;

            case Attribute::INPUT_TYPE_NUMBER:
                $this->setTemplate('/core/edit/input/number.php');
                break;

            case Attribute::INPUT_TYPE_TEXTAREA:
                $this->setTemplate('/core/edit/input/textarea.php');
                break;

            case Attribute::INPUT_TYPE_TEXT:
            default:
                $this->setTemplate('/core/edit/input/text.php');
                break;
        }
    }

    public function setAttribute($attribute) {
        $this->attribute = $attribute;
        return $this;
    }

    public function getAttribute() {
        return $this->attribute;
    }

    public function setEntity($entity) {
        $this->entity = $entity;
        return $this;
    }

    public function getEntity() {
        return $this->entity;
    }

}