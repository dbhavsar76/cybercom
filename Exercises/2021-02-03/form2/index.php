<?php
$self = htmlspecialchars($_SERVER["PHP_SELF"]);
require_once '../common/functions.php';

$name = $pass = $gender = $address = $dob_d = $dob_m = $dob_y = $mstatus = $tnc = '';
$games = [];
$errors = array_fill(0, 8, '');
$errors_cl = array_fill(0, 8, '');
$submit_msg = '';
$male_checked = $female_checked = '';
$married_checked = $unmarried_checked = '';
$games_checked = array_fill(0, 4, '');



if (isset($_POST['submit'])) {
    $name = transform($_POST['name']);
    $pass = transform($_POST['password']);
    $gender = isset($_POST['gender']) ? transform($_POST['gender']) : '';
    $address = transform($_POST['address']);
    $dob_d = transform($_POST['dob-date']);
    $dob_m = transform($_POST['dob-month']);
    $dob_y = transform($_POST['dob-year']);
    $mstatus = isset($_POST['m-status']) ? transform($_POST['m-status']) : '';
    $games = isset($_POST['game']) ? transform(implode(', ', $_POST['game'])) : '';
    $tnc = isset($_POST['tnc']);
    $validated = true;

    if (empty($name)) {
        $validated = false;
        $errors[0] = '* First Name is Required';
    }

    if (empty($pass)) {
        $validated = false;
        $errors[1] = '* Password is Required';
    }

    if (empty($gender)) {
        $validated = false;
        $errors[2] = '* Gender is Required';
    } else {
        $male_checked = ($gender == 'male') ? 'checked' : '';
        $female_checked = ($gender == 'female') ? 'checked' : '';
    }

    if (empty($address)) {
        $validated = false;
        $errors[3] = '* Address is Required';
    }

    if (empty($dob_d) || empty($dob_m) || empty($dob_y)) {
        $validated = false;
        $errors[4] = '* Date Required.';
    } else {
        if (checkdate($dob_m, $dob_d, $dob_y)) {
            $dob = "$dob_y-$dob_m-$dob_d";
        } else {
            $validated = false;
            $errors[4] = '* Invalid Date.';
        }
    }

    if (empty($games)) {
        $validated = false;
        $errors[5] = '* Games is Required';
    } else {
        foreach(explode(', ', $games) as $i => $game) {
            if (!empty($game)) {
                $games_checked[$i] = 'checked';
            }
        }
    }

    if (empty($mstatus)) {
        $validated = false;
        $errors[6] = '* Marital Status is Required';
    } else {
        $married_checked = ($mstatus == 'married') ? 'checked' : '';
        $unmarried_checked = ($mstatus == 'unmarried') ? 'checked' : '';
    }

    if (!$tnc) {
        $validated = false;
        $errors[7] = '* You need to agree to TnC.';
    }

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

$months = [
    "01" => "January",
    "02" => "February",
    "03" => "March",
    "04" => "April",
    "05" => "May",
    "06" => "June",
    "07" => "July",
    "08" => "August",
    "09" => "September",
    "10" => "October",
    "11" => "November",
    "12" => "December",
];

include_once 'index-template.php';