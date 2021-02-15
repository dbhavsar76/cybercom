<?php
include '../includes/config.inc.php';

$formMode = 'Add';
// $formAction = BASE_URL.'products/addProduct.php';
$formAction = $_SERVER['REQUEST_URI'];

include ROOT.'templates/header.template.php';
include ROOT.'templates/categories/categoriesForm.template.php';
include ROOT.'templates/footer.template.php';
