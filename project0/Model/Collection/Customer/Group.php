<?php
namespace Model\Collection\Customer;

class Group extends \Model\Core\Collection {
    public function __construct(array $array = []) {
        parent::__construct($array, '\\Model\\Customer\\Group');
    }
}