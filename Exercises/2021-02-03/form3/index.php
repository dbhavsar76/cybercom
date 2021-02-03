<?php
// vars initiallization
$fname = $lname = $email = $phone = $pass = $pass2 = $gender = $dob_date = $dob_month = $dob_year = $country = $tnc = '';
$errors = array_fill(0, 10, '');
$errors_cl = array_fill(0, 10, '');
$submit_msg = '';

function transform($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST['submit'])) {
    $fname = transform($_POST['firstname']);
    $lname = transform($_POST['lastname']);
    $email = transform($_POST['email']);
    $phone = transform($_POST['phone']);
    $pass = transform($_POST['password']);
    $pass2 = transform($_POST['password2']);
    $gender = isset($_POST['gender']) ? transform($_POST['gender']) : '';
    $country = transform($_POST['country']);
    $dob_date = transform($_POST['dob-date']);
    $dob_month = transform($_POST['dob-month']);
    $dob_year = transform($_POST['dob-year']);
    $tnc = isset($_POST['tnc']);
    $validated = true;

    if (empty($fname)) {
        $validated = false;
        $errors[0] = '* First Name is Required';
    }

    if (empty($lname)) {
        $validated = false;
        $errors[1] = '* Last Name is Required';
    }

    if (empty($dob_date) || empty($dob_month) || empty($dob_year)) {
        $validated = false;
        $errors[2] = '* Date Required.';
    } else {
        if (checkdate($dob_month, $dob_date, $dob_year)) {
            $dob = "$dob_year-$dob_month-$dob_date";
        } else {
            $validated = false;
            $errors[2] = '* Invalid Date.';
        }
    }

    if (empty($gender)) {
        $validated = false;
        $errors[3] = '* Gender is Required';
    }

    if (empty($country)) {
        $validated = false;
        $errors[4] = '* Country is Required';
    }

    if (empty($email)) {
        $validated = false;
        $errors[5] = '* Email is Required';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $validated = false;
        $errors[5] = '* Invalid Email.';
    }

    if (empty($phone)) {
        $validated = false;
        $errors[6] = '* Phone is Required.';
    } else {
        $valid_number = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
        $valid_number = str_replace("-", "", $valid_number);
        if (strlen($valid_number) < 10 || strlen($valid_number) > 14) {
            $validated = false;
            $errors[6] = '* Invalid Phone Number.';
        }
    }

    if (empty($pass)) {
        $validated = false;
        $errors[7] = '* Password is Required';
    } else {
        if (empty($pass2) || $pass != $pass2) {
            $validated = false;
            $errors[8] = '* Password does not match.';
        }
    }

    if (!$tnc) {
        $validated = false;
        $errors[9] = '* You need to agree to TnC.';
    }

    if ($validated) {
        include '../common/db_connect.php';
        $stmt = mysqli_prepare($con, 'INSERT INTO form3 (fname, lname, dob, gender, country, email, phone, password) VALUES (?,?,?,?,?,?,?,?)');
        mysqli_stmt_bind_param($stmt, 'ssssssss', $fname, $lname, $dob, $gender, $country, $email, $phone, $pass);
        mysqli_stmt_execute($stmt);

        // successfully inserted
        if (mysqli_affected_rows($con)) {
            session_start();
            $_SESSION['success'] = true;
            header('location:success.php');
            die();
        } else { // failed to insert
            $submit_msg = 'There was an error Signing Up.<br>Please try again.';
        }
    } else {
        foreach ($errors as $index => $err) {
            if (!empty($err)) {
                $errors_cl[$index] = 'error';
            }
        }
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form 3</title>
    <link rel="stylesheet" href="form3.css">
</head>
<body>
<div class="wrapper">
    <form action="" method="post" id="user-form">
        <table>
            <thead>
                <tr><td colspan="2">Sign Up</td></tr>
            </thead>
            <tbody>
                <tr>
                    <td><label for="firstname">First Name</label></td>
                    <td>
                        <input type="text" name="firstname" id="firstname" placeholder="Enter First Name" class="<?= $errors_cl[0] ?>" value="<?= $fname ?>">
                        <p class="err-msg"><?= $errors[0] ?></p>
                    </td>
                </tr>
                <tr>
                    <td><label for="lastname">Last Name</label></td>
                    <td>
                        <input type="text" name="lastname" id="lastname" placeholder="Enter Last Name" class="<?= $errors_cl[1] ?>" value="<?= $lname ?>">
                        <p class="err-msg"><?= $errors[1] ?></p>
                    </td>
                </tr>
                <tr>
                    <td>Date Of Birth</td>
                    <td>
                        <select name="dob-date" id="dob-date" class="<?= $errors_cl[2] ?>">
                            <option value="">Date</option>
                            <option value="01">01</option>
                            <option value="02">02</option>
                            <option value="03">03</option>
                            <option value="04">04</option>
                            <option value="05">05</option>
                            <option value="06">06</option>
                            <option value="07">07</option>
                            <option value="08">08</option>
                            <option value="09">09</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>
                            <option value="21">21</option>
                            <option value="22">22</option>
                            <option value="23">23</option>
                            <option value="24">24</option>
                            <option value="25">25</option>
                            <option value="26">26</option>
                            <option value="27">27</option>
                            <option value="28">28</option>
                            <option value="29">29</option>
                            <option value="30">30</option>
                            <option value="31">31</option>
                        </select>
                        <select name="dob-month" id="dob-month" class="<?= $errors_cl[2] ?>">
                            <option value="">Month</option>
                            <option value="01">January</option>
                            <option value="02">February</option>
                            <option value="03">March</option>
                            <option value="04">April</option>
                            <option value="05">May</option>
                            <option value="06">June</option>
                            <option value="07">July</option>
                            <option value="08">August</option>
                            <option value="09">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                        <select name="dob-year" id="dob-year" class="<?= $errors_cl[2] ?>">
                            <option value="">Year</option>
                            <option value="2012">2020</option>
                            <option value="2011">2019</option>
                            <option value="2010">2018</option>
                            <option value="2009">2017</option>
                            <option value="2008">2016</option>
                            <option value="2007">2015</option>
                            <option value="2006">2014</option>
                            <option value="2005">2013</option>
                            <option value="2012">2012</option>
                            <option value="2011">2011</option>
                            <option value="2010">2010</option>
                            <option value="2009">2009</option>
                            <option value="2008">2008</option>
                            <option value="2007">2007</option>
                            <option value="2006">2006</option>
                            <option value="2005">2005</option>
                            <option value="2004">2004</option>
                            <option value="2003">2003</option>
                            <option value="2002">2002</option>
                            <option value="2001">2001</option>
                            <option value="2000">2000</option>
                            <option value="1999">1999</option>
                            <option value="1998">1998</option>
                            <option value="1997">1997</option>
                            <option value="1996">1996</option>
                            <option value="1995">1995</option>
                            <option value="1994">1994</option>
                            <option value="1993">1993</option>
                            <option value="1992">1992</option>
                            <option value="1991">1991</option>
                            <option value="1990">1990</option>
                        </select>
                        <p class="err-msg"><?= $errors[2] ?></p>
                    </td>
                </tr>
                <tr>
                    <td>Gender</td>
                    <td>
                        <input type="radio" name="gender" id="ge-m" value="male" class="<?= $errors_cl[3] ?>">
                        <label for="ge-m">Male</label>
                        <input type="radio" name="gender" id="ge-f" value="female" class="<?= $errors_cl[3] ?>">
                        <label for="ge-f">Female</label>
                        <p class="err-msg"><?= $errors[3] ?></p>
                    </td>
                </tr>
                <tr>
                    <td><label for="country">Country</label></td>
                    <td>
                        <select name="country" id="country" class="<?= $errors_cl[4] ?>">
                            <option value="">Country</option>
                            <option value="India">India</option>
                            <option value="Iran">Iran</option>
                            <option value="Iraq">Iraq</option>
                            <option value="Ireland">Ireland</option>
                            <option value="Isle of Man">Isle of Man</option>
                            <option value="Israel">Israel</option>
                            <option value="Italy">Italy</option>
                            <option value="Jamaica">Jamaica</option>
                            <option value="Japan">Japan</option>
                        </select>
                        <p class="err-msg"><?= $errors[4] ?></p>
                    </td>
                </tr>
                <tr>
                    <td><label for="email">E-mail</label></td>
                    <td>
                        <input type="email" name="email" id="email" placeholder="Enter Email" class="<?= $errors_cl[5] ?>" value="<?= $email ?>">
                        <p class="err-msg"><?= $errors[5] ?></p>
                    </td>
                </tr>
                <tr>
                    <td><label for="phone">Phone</label></td>
                    <td>
                        <input type="tel" name="phone" id="phone" placeholder="Enter Phone" class="<?= $errors_cl[6] ?>" value="<?= $phone ?>">
                        <p class="err-msg"><?= $errors[6] ?></p>
                    </td>
                </tr>
                <tr>
                    <td><label for="password">Password</label></td>
                    <td>
                        <input type="password" name="password" id="password" class="<?= $errors_cl[7] ?>">
                        <p class="err-msg"><?= $errors[7] ?></p>
                    </td>
                </tr>
                <tr>
                    <td><label for="cnfrm-pswd">Confirm Password</label></td>
                    <td>
                        <input type="password" name="password2" id="cnfrm-pswd" class="<?= $errors_cl[8] ?>">
                        <p class="err-msg"><?= $errors[8] ?></p>
                    </td>
                </tr>
                <tr>
                    <td> </td>
                    <td>
                        <input type="checkbox" name="tnc[]" id="tnc" class="<?= $errors_cl[9] ?>">
                        <label for="tnc">I agree to the terms of use</label>
                        <p class="err-msg"><?= $errors[9] ?></p>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Submit" name="submit">
                        <input type="reset" value="Reset" name="reset">
                    </td>
                </tr>
            </tfoot>
        </table>
    </form>
    <p class="signup-failed"><?= $submit_msg ?></p>
</div>
</body>
<script src="form3.js"></script>
</html>