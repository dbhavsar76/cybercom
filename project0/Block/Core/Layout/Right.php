<?php
namespace Block\Core\Layout;

class Right extends \Block\Core\Template {
    public function __construct()
    {
        $this->setTemplate('/core/layout/content.php');
    }
}