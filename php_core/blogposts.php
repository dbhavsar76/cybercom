<?php

use Model\Blogpost;

include 'includes/config.inc.php';

if (empty($_SESSION['user_id'])) {
    header('location:'.BASE_URL.'login.php');
}

$blogposts = Blogpost::select_all((int)$_SESSION['user_id']);

include 'templates/header.template.php';
include 'templates/blogposts.template.php';
include 'templates/footer.template.php';