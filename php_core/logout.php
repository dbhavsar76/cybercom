<?php
include 'includes/config.inc.php';

session_destroy();
header('location:'.BASE_URL.'login.php');