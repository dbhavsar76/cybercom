<?php
namespace Block\Admin;

class Footer extends \Block\Core\Template {
    public function __construct() {
        parent::__construct();
        $this->setTemplate('/admin/footer.php');
    }
}