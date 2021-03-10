<?php
namespace Model\Collection\Product;

class Media extends \Model\Core\Collection {
    public function __construct(array $array = []) {
        parent::__construct($array, '\\Model\\Product\\Media');
    }
}