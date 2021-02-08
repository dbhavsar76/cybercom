<?php

require_once 'includes/autoloader.inc.php';

$db = new DB();

$db->insert();
echo '<br>Page Content';
$db->select();
echo '<br>';