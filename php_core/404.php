<?php
include 'includes/config.inc.php';
include 'templates/header.template.php';
include 'templates/404.template.php';

$footer_build_context = [
    'default_js' => false,
];
include 'templates/footer.template.php';