<?php
include 'includes/config.inc.php';
include 'includes/utils.inc.php';

use Forms\LoginForm as Form;
use Model\User;

$form_values = [
    'email' => '',
    'password' => ''
];
$errors = $err_class = $form_values;
$err_msg = '';

// handle form validation, session start etc
if (isset($_POST['submit'])) {
    $validated = true;
    foreach ($_POST as $key => $val) {
        if (array_key_exists($key, $form_values)) {
            $form_values[$key] = input($val);
        }
    }

    Form::validateForm($validated, $form_values, $errors);

    $user = new User(null, null, null, null, $form_values['email'], null, $form_values['password']);
    $user_info = $user->select_this('email');
    if ($user_info === false || $user_info['password'] != $user->password) {
        $validated = false;
        $err_msg = 'Incorrect Email or Password';
    }

    if ($validated) {
        $user->id = $user_info['id'];
        $user->login();
        $_SESSION['user_id'] = $user_info['id'];
        header('location:'.BASE_URL.'blogposts.php');
    } else {
        foreach ($errors as $k => $e) {
            if (!empty($e)) {
                $err_class[$k] = 'error';
            }
        }
    }
}

// rendering the page
$header_build_context = ['include_nav' => false];
include 'templates/header.template.php';
include 'templates/login.template.php';
include 'templates/footer.template.php';