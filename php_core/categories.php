<?php

use Model\Category;

include 'includes/config.inc.php';

if (empty($_SESSION['user_id'])) {
    header('location:'.BASE_URL.'login.php');
}

$categories = Category::select_all();

include 'templates/header.template.php';
include 'templates/categories.template.php';
include 'templates/footer.template.php';