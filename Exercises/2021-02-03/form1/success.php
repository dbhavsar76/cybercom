<?php
    session_start();
    if (isset($_SESSION['success']) && $_SESSION['success']) {
        $msg = 'Registration Successful.';
    } else {
        $msg = 'Registration Failed. Try Again.';
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form 1</title>
</head>
<body>
    <h1><?= $msg ?></h1>
</body>
</html>