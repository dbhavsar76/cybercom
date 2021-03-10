<?php
namespace Model\Collection;

class Admin extends \Model\Core\Collection {
    public function __construct(array $array = []) {
        parent::__construct($array, '\\Model\\Admin');
    }
}