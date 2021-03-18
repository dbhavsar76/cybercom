<?php
namespace Controller\Core;

class Admin extends Base {
    public function __construct() {
        parent::__construct();
        $this->setMessageService(new \Model\Admin\Message);
        $this->setSession(new \Model\Admin\Session);
        $this->setLayout(new \Block\Admin\Layout);
    }
}