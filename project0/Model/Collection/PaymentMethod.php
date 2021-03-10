<?php
namespace Model\Collection;

class PaymentMethod extends \Model\Core\Collection {
    public function __construct(array $array = []) {
        parent::__construct($array, '\\Model\\PaymentMethod');
    }
}