<?php
namespace Model\Collection;

class Category extends \Model\Core\Collection {
    public function __construct(array $array = []) {
        parent::__construct($array, '\\Model\\Category');
    }
}