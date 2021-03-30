<?php
namespace Model\Collection\Cart;

class Address extends \Model\Core\Collection {
    public function __construct(array $array = []) {
        parent::__construct($array, '\\Model\\Cart\\Address');
    }
}