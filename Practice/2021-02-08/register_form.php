<?php
require_once 'includes/autoloader.inc.php';
require_once 'includes/utils.inc.php';
$self = htmlspecialchars($_SERVER['PHP_SELF']);

// initilize variables
$errors = array_fill(0, 5, '');
$err_class = array_fill(0, 5, '');
$msg = '';
$form_values = [
    'name' => '',
    'email' => '',
    'password' => '',
    'password2' => '',
    'birthdate' => ''
];

if (isset($_POST['submit'])) {
    // get variables
    foreach ($_POST as $key => $val) {
        if (array_key_exists($key, $form_values)) {
            $form_values[$key] = input($val);
        }
    }
    $validated = true;

    if (empty($form_values['name'])) {
        $validated = false;
        $errors[0] = '* Name is required.';
    }

    if (empty($form_values['email'])) {
        $validated = false;
        $errors[1] = '* Email is required';
    } else if (!filter_var($form_values['email'], FILTER_VALIDATE_EMAIL)) {
        $validated = false;
        $errors[1] = '* Invalid Email address.';
    }

    if (empty($form_values['password'])) {
        $validated = false;
        $errors[2] = '* Password is required.';
    } else if ($form_values['password'] != $form_values['password2']) {
        $validated = false;
        $errors[3] = '* Passwords don\'t match.';
    }

    $date = explode('-', $form_values['birthdate']);
    if (empty($form_values['birthdate'])) {
        $validated = false;
        $errors[4] = '* Birthdate is required.';
    } else if (!checkdate($date[1], $date[2], $date[0])) {
        $validated = false;
        $errors[4] = '* Invalid Date';
    }

    if ($validated) {
        $db = new DB();
        $params = [$form_values['name'], $form_values['email'], md5($form_values['password']), $form_values['birthdate']];
        $db->insert("INSERT INTO `test_1`(`name`, `email`, `password`, `birthdate`) VALUES(?,?,?,?)", "ssss", $params);
        $msg = 'Added Successfully.';
        $form_values = [
            'name' => '',
            'email' => '',
            'password' => '',
            'password2' => '',
            'birthdate' => ''
        ];        
    } else {
        foreach ($errors as $index => $err) {
            if (!empty($err)) {
                $err_class[$index] = 'error';
            }
        }
    }
}

require 'templates/header.template.php';
require 'templates/register_form.template.php';
require 'templates/footer.template.php';