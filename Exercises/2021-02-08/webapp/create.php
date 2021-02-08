<?php
include_once 'includes/autoloader.inc.php';

// init vars
$form_values = [
    'name' => '',
    'mail' => '',
    'phone' => '',
    'title' => ''
];
$errors = $err_class = $form_values;

// validate and create record
if (isset($_POST['submit'])) {
    // get form values
    $validated = true;
    foreach ($_POST as $key => $val) {
        if (array_key_exists($key, $form_values)) {
            $form_values[$key] = $val;
        }
    }

    if (empty($form_values['name'])) {
        $validated = false;
        $errors['name'] = '* Name is required';
    }

    if (empty($form_values['email'])) {
        $validated = false;
        $errors['email'] = '* Email is required';
    } else if (!filter_var($form_values['email'], FILTER_VALIDATE_EMAIL)) {
        $validated = false;
        $errors['email'] = '* Invalid email address';
    }

    if (empty($form_values['phone'])) {
        $validated = false;
        $errors['phone'] = '* Phone number is required';
    }
}


// render page
include 'templates/header.template.php';
include 'templates/create.template.php';
include 'templates/footer.template.php';