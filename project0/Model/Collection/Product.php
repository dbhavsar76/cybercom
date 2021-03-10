<?php
namespace Model\Collection;

class Product extends \Model\Core\Collection {
    public function __construct(array $array = []) {
        parent::__construct($array, '\\Model\\Product');
    }
}