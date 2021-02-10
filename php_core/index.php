<?php
include 'includes/config.inc.php';

if (!empty($_SESSION['user_id']))
header('location:'.BASE_URL.'blogposts.php');
else
header('location:'.BASE_URL.'login.php');