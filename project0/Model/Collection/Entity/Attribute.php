<?php
namespace Model\Collection\Entity;

class Attribute extends \Model\Core\Collection {
    public function __construct(array $array = []) {
        parent::__construct($array, '\\Model\\Entity\\Attribute');
    }
}