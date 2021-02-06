<?php
require_once '../common/functions.php';

// var initiallization
$name = $email = $subject = $message = '';
$name_err = $email_err = $subject_err = $message_err =  '';
$name_class = $email_class = $subject_class = $message_class = '';
$submit_msg = $submit_class = '';


if (isset($_POST['submit'])) {
    $name = transform($_POST['name']);
    $email = transform($_POST['email']);
    $subject = transform($_POST['subject']);
    $message = transform($_POST['message']);
    $validated = true;

    if (empty($name)) {
        $validated = false;
        $name_err = '* Name is Requred.';
        $name_class = 'error';
    }

    if (empty($email)) {
        $validated = false;
        $email_err = '* Email is Required.';
        $email_class = 'error';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $validated = false;
        $email_err = '* Invalid Email Format.';
        $email_class = 'error';
    }

    if (empty($subject)) {
        $validated = false;
        $subject_err = '* Subject is Required.';
        $subject_class = 'error';
    } else if (strlen($subject) > 128) {
        $validated = false;
        $subject_err = '* Subject exceeded 128 character limit.';
        $submit_class = 'error';
    }

    if (empty($message)) {
        $validated = false;
        $message_err = '* Message is Required.';
        $message_class = 'error';
    }

    // if validated then insert into db
    if ($validated) {
        include '../common/db_connect.php';
        $stmt = mysqli_prepare($con, 'INSERT INTO form4 (name, email, subject, message) VALUES (?,?,?,?)');
        mysqli_stmt_bind_param($stmt, 'ssss', $name, $email, $subject, $message);
        mysqli_stmt_execute($stmt);
        $affected_rows = mysqli_affected_rows($con);

        // successfully inserted
        if ($affected_rows) {
            $submit_msg = 'Posted Successfully!';
            $submit_class = 'green';
            $name = $email = $subject = $message = ''; // reset vars so form is empty again
        } else { // failed to insert
            $submit_msg = 'There was an error posting your message.<br>Please try again.';
            $submit_class = 'red';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form 4</title>
    <link rel="stylesheet" href="form4.css">
</head>
<body>
    <div class="wrapper">
        <form action="" method="post" id="contact-form">
            <div class="title">Contact Us!</div>
            <div class="inputs">
                <input type="text" name="name" id="name" placeholder="Name...">
                <p class="error-msg"><?= $name_err ?></p>
                <input type="email" name="email" id="email" placeholder="Email...">
                <p class="error-msg"><?= $email_err ?></p>
                <input type="text" name="subject" id="subject" placeholder="Subject...">
                <p class="error-msg"><?= $subject_err ?></p>
                <textarea name="message" id="message" rows="5" placeholder="Message..."></textarea>
                <p class="error-msg"><?= $message_err ?></p>
            </div>
            <div class="submit-div">
                <input type="submit" value="Send Message" name="submit">
            </div>
            <div class="sub-msg <?= $submit_class ?>"><?= $submit_msg ?></div>
        </form>
    </div>
</body>
<script src="form4.js"></script>
</html>