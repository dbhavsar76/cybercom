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

    // todo: implement file validation
    // create database and change the insert code

    if ($validated) {
        require '../common/db_connect.php';
        $stmt = mysqli_prepare($con, 'INSERT INTO form2 (name, password, gender, address, dob, games, mstatus) VALUES (?,?,?,?,?,?,?)');
        mysqli_stmt_bind_param($stmt, 'sssssss', $name, $pass, $gender, $address, $dob, $games, $mstatus);
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