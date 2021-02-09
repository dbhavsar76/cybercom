<?php
require 'includes/autoloader.inc.php';
require 'includes/utils.inc.php';

use Model\Contact;
use Update\Form;

// init vars
$form_values = [
    'id' => '',
    'name' => '',
    'email' => '',
    'phone' => '',
    'title' => '',
    'created' => ''
];
$errors = $err_class = $form_values;
$err_msg = '';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $contact = new Contact($_GET['id']);
    $result = $contact->selectThis();
    if ($result == false) {
        header('location:404.php');
    } else {
        foreach ($result as $k => $v) {
            $form_values[$k] = $v;
        }
    }
} else if (isset($_POST['submit'])) {
    $validated = true;
    foreach ($_POST as $key => $val) {
        if (array_key_exists($key, $form_values)) {
            $form_values[$key] = input($val);
        }
    }

    Form::validateForm($validated, $form_values, $errors);

    if ($validated) {
        $contact = new Contact($form_values['id'], $form_values['name'], $form_values['email'], $form_values['phone'], $form_values['title']);
        $result = $contact->update();
        if ($result) {
            session_start();
            $_SESSION['success'] = 'Contact Updated Successfully.';
            header('location:contacts.php');
            die();
        } else {
            $err_msg = 'There was some problem updating the record.';
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
include 'templates/update.template.php';
include 'templates/footer.template.php';