<?php

$host = 'localhost';
$user = 'dhrv';
$password = 'q1w2e3r4';
$db = 'test';

$con = mysqli_connect($host, $user, $password, $db);
if (!$con) {
    die('Error connecting to Database : '.mysqli_connect_error());
}