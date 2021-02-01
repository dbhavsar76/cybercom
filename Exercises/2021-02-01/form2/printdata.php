<?php

if (!isset($_POST['submit'])) {
    echo 'There\'s nothing to show here.';
    die();
}
$dob = $_POST['dob-date'].'-'.$_POST['dob-month'].'-'.$_POST['dob-year'];
$games = implode(', ', $_POST['game']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form 2</title>
</head>
<body>
    <h1>Submitted Data</h1>
    <p>Name : <?= $_POST['name'] ?></p>
    <p>Password : <?= $_POST['password'] ?></p>
    <p>Gender : <?= $_POST['gender'] ?></p>
    <p>Address : <?= $_POST['address'] ?></p>
    <p>Date of Birth : <?= $dob ?></p>
    <p>Games : <?= $games ?></p>
    <p>Marital Status : <?= $_POST['m-status'] ?></p>
</body>
</html>