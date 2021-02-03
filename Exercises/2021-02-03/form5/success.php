<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form 5</title>
</head>
<body>
    <h1>Sign In Successful</h1>
    <p>
        Hello, User! <br>
        Email : <?= $_SESSION['email'] ?>
    </p>
</body>
</html>