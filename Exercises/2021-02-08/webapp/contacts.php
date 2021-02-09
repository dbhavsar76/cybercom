<?php
include_once 'includes/autoloader.inc.php';
use Model\Contact;


session_start();
$msg = '';
if (isset($_SESSION['success'])) {
    $msg = $_SESSION['success'];
}
session_destroy();

$contacts = Contact::selectAll();

include 'templates/header.template.php';
include 'templates/contacts.template.php';
include 'templates/footer.template.php';