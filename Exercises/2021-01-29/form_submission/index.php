<?php
    // initialize variables for values and errors
    $name = $email = $age = $gender = $address = $plan = '';
    $name_err = $email_err = $age_err = $gender_err = $plan_err = $agreement_err = '';

    function transform($str) {
        $str = trim($str);
        $str = stripslashes($str);
        $str = htmlspecialchars($str);
        return $str;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Submission Exercise</title>
    <style>
        .error { color: red; }
        td { padding: 5px; }
    </style>
</head>
<body>
<?php
    // validating input if submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // validating name
        if (empty($_POST['name'])) {
            $name_err = 'Name is REQUIRED';
        } else {
            $name = transform($_POST['name']);
        }

        // validating email address
        if (empty($_POST['email'])) {
            $email_err = 'Email is REQUIRED';
        } else {
            $email = transform($_POST['email']);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $email_err = 'Email address is INVALID FORMAT';
            }
        }

        // validating age
        if (empty($_POST['age'])) {
            $age_err = 'Age is REQUIRED';
        } else {
            $age = intval(transform($_POST['age']));
            if ($age <= 0 || $age > 120) {
                $age_err = 'Age is INVALID';
            }
        }
        
        // validating gender
        if (empty($_POST['gender'])) {
            $gender_err = 'Gender is REQUIRED';
        } else {
            $gender = transform($_POST['gender']);
        }

        // validating address
        if (empty($_POST['address'])) {
            $address = 'N/A';
        } else {
            $address = transform($_POST['address']);
        }

        // validating plan
        if (empty($_POST['plan'])) {
            $plan_err = 'Plan is REQUIRED';
        } else {
            $plan = transform($_POST['plan']);
        }

        // checking if agreement accepted
        if (!isset($_POST['agreement'])) {
            $agreement_err = 'You must AGREE to the terms and conditions.';
        }
    }
?>

    <h1>Registration Form</h1>
    <p class="error">* - required fields.</p>

    <form action="" method="post">
        <table>
            <tr>
                <td><label for="name">Name</label></td>
                <td>
                    <input type="text" name="name" id="name">
                    <span class="error">* <?= $name_err ?></span>
                </td>
            </tr>
            <tr>
                <td><label for="email">Email</label></td>
                <td>
                    <input type="email" name="email" id="email">
                    <span class="error">* <?= $email_err ?></span>
                </td>
            </tr>
            <tr>
                <td><label for="age">Age</label></td>
                <td>
                    <input type="number" name="age" id="age">
                    <span class="error">* <?= $age_err ?></span>
                </td>
            </tr>
            <tr>
                <td>Gender</td>
                <td>
                    <input type="radio" name="gender" id="male" value="male">
                    <label for="male">Male</label> &nbsp;
                    <input type="radio" name="gender" id="female" value="female">
                    <label for="male">Female</label>
                    <span class="error">* <?= $gender_err ?></span>
                </td>
            </tr>
            <tr>
                <td><label for="address">Address</label></td>
                <td>
                    <textarea name="address" id="address"></textarea>
                </td>
            </tr>
            <tr>
                <td><label for="plan">Plan Type</label></td>
                <td>
                    <select name="plan" id="plan">
                        <option value="">-- select plan --</option>
                        <option value="free">Free</option>
                        <option value="professional">Professional</option>
                        <option value="enterprise">Enterprise</option>
                    </select><span class="error">* <?= $plan_err ?></span>
                </td>
            </tr>
            <tr>
                <td><label for="agreement">Agree to terms and conditions</label></td>
                <td>
                    <input type="checkbox" name="agreement" id="agreement">
                    <span class="error">* <?= $agreement_err ?></span>
                </td>
            </tr>
            <tr>
                <td><input type="submit" value="submit">
                <input type="reset" value="reset"></td>
            </tr>
        </table>
    </form><br><br>
    
<?php if ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
    <h2>Your Submitted Values</h2>
    <p>Name : <?= $name ?></p>
    <p>Email : <?= $email ?></p>
    <p>Age : <?= $age ?></p>
    <p>Gender : <?= $gender ?></p>
    <p>Address : <?= $address ?></p>
    <p>Plan : <?= $plan ?></p>
<?php endif; ?>
</body>
</html>