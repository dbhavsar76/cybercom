<?php
namespace Model\Collection;

class ShippingMethod extends \Model\Core\Collection {
    public function __construct(array $array = []) {
        parent::__construct($array, '\\Model\\ShippingMethod');
    }
}