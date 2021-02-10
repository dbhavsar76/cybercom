<?php
include 'includes/config.inc.php';
include 'includes/utils.inc.php';

use Forms\BlogpostForm as Form;
use Model\Blogpost;
use Model\Category;

if (empty($_SESSION['user_id'])) {
    header('location:'.BASE_URL.'login.php');
}

$form_values = [
    'id' => '',
    'title' => '',
    'content' => '',
    'url' => '',
    'published' => '',
    'category' => '',
    'image' => '',
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
    $form_values['image'] = isset($_FILES['image']) ? $_FILES['image'] : [];

    Form::validateForm($validated, $form_values, $errors);

    
    if ($validated) {
        $blogpost = new Blogpost(
            null,
            $_SESSION['user_id'],
            $form_values['title'],
            $form_values['content'],
            $form_values['url'],
            $form_values['image'],
            $form_values['published']);
        $insert_id = $blogpost->insert($form_values['category']);
        if (!$insert_id) {
            $err_msg = 'Add blogpost Failed.';
        } else {
            $target = "img/blogpost/$insert_id.png";
            if (file_exists($target)) {
                unlink($target);
            }
            move_uploaded_file($form_values['image']['tmp_name'], $target);
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

$categories = Category::select_all();
$h1 = 'Add Blogpost';
$self = 'add_blogpost.php';

include 'templates/header.template.php';
include 'templates/add_blogpost.template.php';
include 'templates/footer.template.php';