<?php

include_once 'includes/autoloader.inc.php';
use Person\Person;
use Person\Teacher;

$p = new Person('John');
echo $p->greet(), '<br>';

$t = new Teacher('Jane', 'Biology');
echo $t->greet();

echo '<br><pre>';
print_r(pathinfo($_SERVER['REQUEST_URI'], PATHINFO_FILENAME));