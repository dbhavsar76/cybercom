<?php
include 'includes/config.inc.php';
include 'includes/utils.inc.php';

use Forms\CategoryForm as Form;
use Model\Category;

if (empty($_SESSION['user_id'])) {
    header('location:'.BASE_URL.'login.php');
}

$form_values = [
    'id' => '',
    'title' => '',
    'content' => '',
    'url' => '',
    'meta_title' => '',
    'parent_id' => '',
    'image' => ''
];
$errors = $err_class = $form_values;
$err_msg = '';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $category = new Category($_GET['id']);
    $result = $category->select_this();
    if ($result == false) {
        header('location:404.php');
    } else {
        foreach ($result as $k => $v) {
            $form_values[$k] = $v;
        }
    }
}
// handle form validation, session start etc
else if (isset($_POST['submit'])) {
    $validated = true;
    foreach ($_POST as $key => $val) {
        if (array_key_exists($key, $form_values)) {
            $form_values[$key] = input($val);
        }
    }
    $form_values['image'] = isset($_FILES['image']) ? $_FILES['image'] : [];
    Form::validateForm($validated, $form_values, $errors, 'edit');

    
    if ($validated) {
        $category = new Category(
            $form_values['id'],
            $form_values['parent_id'],
            $form_values['title'],
            $form_values['meta_title'],
            $form_values['url'],
            $form_values['content']);
        $insert_id = $category->update();
        if (!$insert_id) {
            $err_msg = 'Edit Category Failed.';
        } else {
            $target = "img/category/$insert_id.png";
            if (file_exists($target)) {
                unlink($target);
            }
            move_uploaded_file($form_values['image']['tmp_name'], $target);
            header('location:'.BASE_URL.'categories.php');
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
$h1 = 'Edit Category';
$self = 'edit_category.php';

include 'templates/header.template.php';
include 'templates/add_category.template.php';
include 'templates/footer.template.php';