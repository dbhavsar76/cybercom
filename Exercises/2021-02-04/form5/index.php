<?php 
require_once '../common/functions.php';

// initiallizing vars
$email = $pass = '';
$email_err = $pass_err = $sign_in_error = '';
$email_class = $pass_class = '';


if (isset($_POST['submit'])) {
    $email = transform($_POST['email']);
    $pass = transform($_POST['password']);
    echo $email . ' ' . $pass . '<br>';
    $validated = true;
    
    if (empty($email)) {
        $email_err = '* Email is Required.';
        $email_class = 'error';
        $validated = false;
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_err = '* Invalid email format.';
        $email_class = 'error';
        $validated = false;
    }
    
    if (empty($pass)) {
        $pass_err = '* Password is Required.';
        $pass_class = 'error';
        $validated = false;
    }
    
    // if validated then search in db and if found go to success
    // else show an error
    if ($validated) {
        include '../common/db_connect.php';
        $sql = "SELECT * FROM form5 WHERE email = '$email'";
        $result = mysqli_query($con, $sql);

        // if email matched then there is a row in the result
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            // if password matches then redirect
            if ($row['password'] == $pass) {
                mysqli_close($con);
                session_start();
                $_SESSION['email'] = $email;
                header('location:success.php');
                die();
            } else {
                $sign_in_error = 'Sign In Failed.<br>Incorrect Password';
            }
        } else {
            $sign_in_error = 'Sign In Failed<br>Incorrect Email';
        }
        mysqli_close($con);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form 5</title>
    <link rel="stylesheet" href="form5.css">
</head>
<body>
    <div class="wrapper">
        <div class="title">Sign Up</div>
        <div class="frm-div">
            <form action="" method="post" id="sign-in-form">
                <label for="email">E-mail Address</label>
                <input type="email" name="email" id="email" placeholder="mail@address.com" value="<?= $email ?>" class="<?= $email_class ?>">
                <p class="error-msg"><?= $email_err ?></p>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;" value="<?= $pass ?>" class="<?= $pass_class?>">
                <p class="error-msg"><?= $pass_err ?></p>
                <input type="submit" value="Sign In" name="submit">
                <p class="error-msg big"><?= $sign_in_error ?></p>
            </form>
        </div>
    </div>
</body>
<script src="form5.js"></script>
</html>