<?php
namespace Model\Collection;

class Cart extends \Model\Core\Collection {
    public function __construct(array $array = []) {
        parent::__construct($array, '\\Model\\Cart');
    }
}