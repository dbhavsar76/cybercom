<?php
require_once ROOT.'\\Model\\Core\\Model_Table.php';

class Model_Customer extends Model_Table {
    public function __construct() {
        parent::__construct();
        $this->setTableName('customer');
        $this->setPrimaryKey('id');
    }
}