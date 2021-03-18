<?php
namespace Model\Collection;

class CmsPage extends \Model\Core\Collection {
    public function __construct(array $array = []) {
        parent::__construct($array, '\\Model\\CmsPage');
    }
}