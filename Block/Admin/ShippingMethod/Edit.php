<?php
namespace Block\Admin\ShippingMethod;

class Edit extends \Block\Core\Edit {
    public function __construct($id = null) {
        parent::__construct($id);
        $this->title = 'Shipping Method';
    }
}