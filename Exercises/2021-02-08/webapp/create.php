<?php
require 'includes/autoloader.inc.php';
require 'includes/utils.inc.php';

use Create\Form;
use Model\Contact;

// init vars
$form_values = [
    'name' => '',
    'email' => '',
    'phone' => '',
    'title' => ''
];
$errors = $err_class = $form_values;
$err_msg = '';

// validate and create record
if (isset($_POST['submit'])) {
    // get form values
    $validated = true;
    foreach ($_POST as $key => $val) {
        if (array_key_exists($key, $form_values)) {
            $form_values[$key] = input($val);
        }
    }

    Form::validateForm($validated, $form_values, $errors);

    if ($validated) {
        $contact = new Contact(null, $form_values['name'], $form_values['email'], $form_values['phone'], $form_values['title']);
        $result = $contact->insert();
        if ($result) {
            session_start();
            $_SESSION['success'] = 'Contact Added Successfully';
            header('location:contacts.php');
            die();
        } else {
            $err_msg = 'There was some problem creating the record.';
        }
    } else {
        foreach ($errors as $k => $e) {
            if (!empty($e)) {
                $err_class[$k] = 'error';
            }
        }
    }
}


// render page
include 'templates/header.template.php';
include 'templates/create.template.php';
include 'templates/footer.template.php';