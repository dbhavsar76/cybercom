<?php
// warning: only send request trhough ajax
include 'includes/autoloader.inc.php';

use Model\Contact;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' && !empty($_POST['id'])) {
    $contact = new Contact($_POST['id']);
    $result = $contact->delete();
    if ($result) {
        echo 'success';
    } else {
        echo 'fail';
    }
} else {
    header('location:404.php');
}