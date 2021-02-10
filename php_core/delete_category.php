<?php

include 'includes/config.inc.php';

use Model\Category;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' && !empty($_POST['id'])) {
    $cat = new Category($_POST['id']);
    $result = $cat->delete();
    if ($result) {
        echo 'success';
    } else {
        echo 'fail';
    }
} else {
    header('location:404.php');
}