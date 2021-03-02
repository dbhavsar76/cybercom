<?php

class Model_Admin_Session extends Model_Core_Session {
    public function __construct() {
        parent::__construct();
        $this->setNameSpace('admin');
    }
}