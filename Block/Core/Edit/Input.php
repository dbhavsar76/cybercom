<?php
namespace Block\Core\Edit;

use Model\Entity\Attribute;

class Input extends \Block\Core\Template {
    protected $options = null;
    protected $value = null;
    protected $id = null;
    protected $name = null;

    public function __construct($type) {
        parent::__construct();
        if ($type) {
            $this->setType($type);
        }
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
                                    
            case Attribute::INPUT_TYPE_TEXT:
            default:
                $this->setTemplate('/core/edit/input/text.php');
                break;
        }
    }

    public function setOptions($options) {
        $this->options = $options;
        return $this;
    }

    public function getOptions() {
        return $this->options;
    }

    public function setValue($value) {
        $this->value = $value;
        return $this;
    }

    public function getValue() {
        return $this->value;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getId() {
        return $this->id;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function getName() {
        return $this->name;
    }
}