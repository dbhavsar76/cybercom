<?php

if (!isset($_POST['submit'])) {
    echo 'There\'s nothing to show here.';
    die();
}
$dob = $_POST['dob-date'].'-'.$_POST['dob-month'].'-'.$_POST['dob-year'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form 3</title>
</head>
<body>
    <h1>Submitted Data</h1>
    <p>First Name : <?= $_POST['firstname'] ?></p>
    <p>Last Name : <?= $_POST['lastname'] ?></p>
    <p>Date of Birth : <?= $dob ?></p>
    <p>Gender : <?= $_POST['gender'] ?></p>
    <p>Country : <?= $_POST['country'] ?></p>
    <p>Email : <?= $_POST['email'] ?></p>
    <p>Phone : <?= $_POST['phone'] ?></p>
    <p>Password : <?= $_POST['password'] ?></p>
</body>
</html>