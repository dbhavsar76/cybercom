<?php

namespace Person;

class Teacher extends Person {
    private $subject;

    function __construct($name, $subject) {
        parent::__construct($name);
        $this->subject = $subject;
    }

    public function greet() {
        return "Hello! I'm {$this->name} and I teach {$this->subject}.";
    }
}