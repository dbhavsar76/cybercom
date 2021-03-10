<?php
namespace Model\Collection\Product\Group;

class Price extends \Model\Core\Collection {
    public function __construct(array $array = []) {
        parent::__construct($array, '\\Model\\Product\\Group\\Price');
    }
}