<?php
$self = htmlspecialchars($_SERVER["PHP_SELF"]);
require_once '../common/functions.php';

$games_a = ['hockey', 'football', 'badminton', 'cricket', 'volleyball'];
$name = $pass = $gender = $address = $age_grp = '';
$games = [];
$errors = array_fill(0, 7, '');
$errors_cl = array_fill(0, 7, '');
$submit_msg = '';
$male_checked = $female_checked = '';
$games_checked = array_fill(0, count($games_a), '');
$img_file = isset($_FILES['image']) ? $_FILES['image'] : [];
$allowed_types = [IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_JPEG2000];


if (isset($_POST['submit'])) {
    $name = transform($_POST['name']);
    $pass = transform($_POST['password']);
    $address = transform($_POST['address']);
    $games = isset($_POST['game']) ? $_POST['game'] : [];
    $gender = isset($_POST['gender']) ? transform($_POST['gender']) : '';
    $age_grp = transform($_POST['age-grp']);
    $validated = true;

    if (empty($name)) {
        $validated = false;
        $errors[0] = '* First Name is Required';
    }

    if (empty($pass)) {
        $validated = false;
        $errors[1] = '* Password is Required';
    }

    if (empty($address)) {
        $validated = false;
        $errors[2] = '* Address is Required';
    }


    if (empty($games)) {
        $validated = false;
        $errors[3] = '* Games is Required';
    } else {
        foreach ($games_a as $i => $game) {
            if(array_search($game, $games)) {
                $games_checked[$i] = 'checked';
            }
        }
    }

    if (empty($gender)) {
        $validated = false;
        $errors[4] = '* Gender is Required';
    } else {
        $male_checked = ($gender == 'male') ? 'checked' : '';
        $female_checked = ($gender == 'female') ? 'checked' : '';
    }

    if (empty($age_grp)) {
        $validated = false;
        $errors[5] = '* Age Group is Required';
    }

    // check if image is uploaded
    if (empty($img_file) || empty($img_file['name']) || !file_exists($img_file['tmp_name'])) {
        $validated = false;
        $errors[6] = '* Image upload is Required.';
    } else {
        $info = getimagesize($img_file['tmp_name']);
        // check if file uploaded is an image
        if ($info === false) {
            $validated = false;
            $errors[6] = '* Uploaded file is not an image or is a corrupt file.';
        } else if (array_search($info[2], $allowed_types) === false) {
            // check if image is of allowed type
            $validated = false;
            $errors[6] = '* Image type is not PNG, JPG or JPEG.';
        } // can also add resolution check with $info[0] (width) and $info[1] (height)
        else if ($img_file['size'] > 2000000) {
            $validated = false;
            $errors[6] = '* Image size exceeds 2MB.';
        }
        else {
            $img_file_name = basename($img_file['name']);
            $target = "img/$img_file_name";
            if (file_exists($target)) {
                unlink($target);
            }
            if (!move_uploaded_file($img_file['tmp_name'], $target)) {
                $validated = false;
                $errors[6] = '* Image upload Failed.';
            }
        }
    }


    if ($validated) {
        require '../common/db_connect.php';

        $stmt = mysqli_prepare($con, 'INSERT INTO form1 (name, password, address, games, gender, agegroup, picture) VALUES (?,?,?,?,?,?,?)');
        mysqli_stmt_bind_param($stmt, 'sssssis', $name, $pass, $address, $games, $gender, $age_grp, $img_file_name);
        mysqli_stmt_execute($stmt);

        // successfully inserted
        if (mysqli_affected_rows($con)) {
            session_start();
            $_SESSION['success'] = true;
            header('location:success.php');
            die();
        } else { // failed to insert
            $submit_msg = 'There was an error in registration.<br>Please try again.';
        }
    } else {
        foreach ($errors as $index => $err) {
            if (!empty($err)) {
                $errors_cl[$index] = 'error';
            }
        }
    }
}

include_once 'index-template.php';