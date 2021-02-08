<?php

class TestClass {
    function __construct()
    {
        echo '<br>Constructor';        
    }

    function __destruct()
    {
        echo '<br>Destructor';
    }
}