<?php 
namespace Model\Collection\Cart;

class Item extends \Model\Core\Collection {
    public function __construct(array $array = []) {
        parent::__construct($array, '\\Model\\Cart\\Item');
    }
}