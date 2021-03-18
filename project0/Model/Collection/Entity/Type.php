<?php
namespace Model\Collection\Entity;

class Type extends \Model\Core\Collection {
    public function __construct(array $array = []) {
        parent::__construct($array, '\\Model\\Entity\\Type');
    }
}