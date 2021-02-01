<?php

// if you didn't came here by form submission then you don't get to see anything
if (!isset($_POST['submit'])) {
    echo 'There\'s nothing to show here.';
    die();
}

// prepare some variables
$games = implode(', ', $_POST['game']);
$t = 10*intval($_POST['age-grp']);
$age_group = ($t-10) . ' - ' . ($t-1);

// then print everything

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
    <p>Address : <?= $_POST['address'] ?></p>
    <p>Games : <?= $games ?></p>
    <p>Gender : <?= $_POST['gender'] ?></p>
    <p>Age Group : <?= $age_group ?></p>
    <p>File Info : <pre>
    <?php
        foreach ($_FILES['image'] as $k => $v) {
            echo "\t$k : $v <br>";
        }
    ?></pre>
    </p>
</body>
</html>