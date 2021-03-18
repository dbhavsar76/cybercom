<?php
namespace Model\Collection;

class Customer extends \Model\Core\Collection {
    public function __construct(array $array = []) {
        parent::__construct($array, '\\Model\\Customer');
    }
}