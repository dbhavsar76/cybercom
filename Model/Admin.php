<?php
namespace Model;

class Admin extends \Model\Core\Table {
    public const STATUS_ENABLED = 'enabled';
    public const STATUS_DISABLED = 'disabled';
    
    public function __construct() {
        parent::__construct();
        $this->setTableName('admin');
        $this->setPrimaryKey('id');
    }
}