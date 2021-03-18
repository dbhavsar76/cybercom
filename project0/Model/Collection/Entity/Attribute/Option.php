<?php
namespace Model\Collection\Entity\Attribute;

class Option extends \Model\Core\Collection {
    public function __construct(array $array = []) {
        parent::__construct($array, '\\Model\\Entity\\Attribute\\Option');
    }
}