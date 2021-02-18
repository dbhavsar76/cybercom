<?php
require_once ROOT.'\\Model\\Core\\Model_Table.php';

class Model_Product extends Model_Table {
    public function __construct() {
        parent::__construct();
        $this->setTableName('product');
        $this->setPrimaryKey('id');
    }
}