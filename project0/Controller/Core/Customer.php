<?php
namespace Controller\Core;

class Customer extends Base {
    public function __construct() {
        parent::__construct();
        $this->setMessageService(new \Model\Customer\Message);
        $this->setSession(new \Model\Customer\Session);
        $this->setLayout(new \Block\Layout);
    }
}