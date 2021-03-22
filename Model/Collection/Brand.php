<?php
namespace Model\Collection;

class Brand extends \Model\Core\Collection {
    public function __construct(array $array = []) {
        parent::__construct($array, '\\Model\\Brand');
    }
}