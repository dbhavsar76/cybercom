<?php

class Model_Collection_Product extends Model_Core_Collection {
    public function __construct(array $array = []) {
        parent::__construct($array, 'Model_Product');
    }
}