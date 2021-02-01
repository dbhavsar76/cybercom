<?php

if (!isset($_POST['submit'])) {
    echo 'There\'s nothing to show here.';
    die();
} else {
    $email = $_POST['email'];
    $pass = $_POST['password'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form 5</title>
</head>
<body>
    <h1>Submitted Data</h1>
    <h3>Email : <?= $email ?></h3>
    <h3>Password : <?= $pass ?></h3>
</body>
</html>