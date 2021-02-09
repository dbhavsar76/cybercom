<?php

include_once 'includes/autoloader.inc.php';
use Person\Person;
use Person\Teacher;

function fun(&$arr) {
    $arr[2] = 'error';
    $arr[4] = 'error';
}

$p = new Person('John');
echo $p->greet(), '<br>';

$t = new Teacher('Jane', 'Biology');
echo $t->greet();

echo '<br><pre>';
print_r(pathinfo($_SERVER['REQUEST_URI'], PATHINFO_FILENAME));

$d = new DateTimeImmutable();
echo '<br>', $d->format('Y-m-d H:i:s');

$arr = array_fill(0, 7, '');
fun($arr);
print_r($arr);