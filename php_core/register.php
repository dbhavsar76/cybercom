<?php
include 'includes/config.inc.php';
include 'includes/utils.inc.php';

use Forms\RegisterForm as Form;
use Model\User;

$form_values = [
    'prefix' => '',
    'first_name' => '',
    'last_name' => '',
    'email' => '',
    'mobile' => '',
    'password' => '',
    'password2' => '',
    'information' => '',
    'tnc' => '',
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

    
    if ($validated) {
        $user = new User(
            null,
            $form_values['prefix'],
            $form_values['first_name'],
            $form_values['last_name'],
            $form_values['email'],
            $form_values['mobile'],
            $form_values['password'],
            $form_values['information']);
        $insert_id = $user->insert();
        if (!$insert_id) {
            $err_msg = 'Registeration Failed.';
        } else {
            $_SESSION['user_id'] = $insert_id;
            header('location:'.BASE_URL.'blogposts.php');
        }
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
include 'templates/register.template.php';
include 'templates/footer.template.php';