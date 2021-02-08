<?php

namespace Person;

class Person {
    protected $name;

    function __construct($name) {
        $this->name = $name;
    }

    public function greet() {
        return "Hello! I'm {$this->name}.";
    }
}