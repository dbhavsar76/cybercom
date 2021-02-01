<?php

if (!isset($_POST['submit'])) {
    echo 'There\'s nothing to show here.';
    die();
} else {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form 4</title>
</head>
<body>
    <h1>Submitted Data</h1>
    <p>Name : <?= $name ?></p>
    <p>Email : <?= $email ?></p>
    <p>Subject : <?= $subject ?></p>
    <p>Message : <?= $message ?></p>
</body>
</html>