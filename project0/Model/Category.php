<?php

class Model_Category extends Model_Core_Table {
    public const STATUS_ENABLED = 1;
    public const STATUS_DISABLED = 0;
    
    public function __construct() {
        parent::__construct();
        $this->setTableName('category');
        $this->setPrimaryKey('id');
    }
}