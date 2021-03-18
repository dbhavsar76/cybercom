<?php
namespace Block\Admin\Customer\Group;

class Edit extends \Block\Core\Edit {
    public function __construct($id = null) {
        parent::__construct($id);
        $this->title = 'Customer Group';
    }
}