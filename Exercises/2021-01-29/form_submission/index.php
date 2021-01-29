<?php
    // initialize variables for values and errors
    $name = $email = $age = $gender = $address = $plan = '';
    $name_err = $email_err = $age_err = $gender_err = $plan_err = $agreement_err = '';
    $gender_male = 'checked';
    $gender_female = '';
    $plan_free = $plan_pro = $plan_ent = '';
    $validated = false;

    function transform($str) {
        $str = trim($str);
        $str = stripslashes($str);
        $str = htmlspecialchars($str);
        return $str;
    }

    // validating input if submitted
    if (isset($_POST['submit'])) {
        $name = transform($_POST['name']);
        $email = transform($_POST['email']);
        $age = intval(transform($_POST['age']));
        $gender = transform($_POST['gender']);
        $address = transform($_POST['address']);
        $plan = transform($_POST['plan']);
        $validated = true;

        // validating name
        if (empty($name)) {
            $name_err = 'Name is REQUIRED';
            $validated = false;
        }

        // validating email address
        if (empty($email)) {
            $email_err = 'Email is REQUIRED';
            $validated = false;
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_err = 'Email address is INVALID FORMAT';
            $validated = false;
        }

        // validating age
        if (empty($age)) {
            $age_err = 'Age is REQUIRED';
            $validated = false;
        } else if ($age <= 0 || $age > 120) {
            $age_err = 'Age is INVALID';
            $validated = false;
        }
        
        // validating gender
        if (empty($gender)) {
            $gender_err = 'Gender is REQUIRED';
            $validated = false;
        } else if ($gender == 'male') {
            $gender_male = 'checked';
        } else if ($gender == 'female') {
            $gender_male = '';
            $gender_female = 'checked';
        } else {
            $gender_err = 'INVALID Selection.';
            $validated = false;
        }

        // validating address
        if (empty($address)) {
            $address = 'N/A';
        }

        // validating plan
        if (empty($plan)) {
            $plan_err = 'Plan is REQUIRED';
            $validated = false;
        } else if ($plan == 'free') {
            $plan_free = 'selected';
        } else if ($plan == 'professional') {
            $plan_pro = 'selected';
        } else if ($plan == 'enterprise') {
            $plan_ent = 'selected';
        }

        // checking if agreement accepted
        if (!isset($_POST['agreement'])) {
            $agreement_err = 'You must AGREE to the terms and conditions.';
            $validated = false;
        }
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
    <h1>Registration Form</h1>
    <p class="error">* - required fields.</p>

    <form action="" method="post">
        <table>
            <tr>
                <td><label for="name">Name</label></td>
                <td>
                    <input type="text" name="name" id="name" value="<?= $name ?>">
                    <span class="error">* <?= $name_err ?></span>
                </td>
            </tr>
            <tr>
                <td><label for="email">Email</label></td>
                <td>
                    <input type="email" name="email" id="email" value="<?= $email ?>">
                    <span class="error">* <?= $email_err ?></span>
                </td>
            </tr>
            <tr>
                <td><label for="age">Age</label></td>
                <td>
                    <input type="number" name="age" id="age" value="<?= $age ?>">
                    <span class="error">* <?= $age_err ?></span>
                </td>
            </tr>
            <tr>
                <td>Gender</td>
                <td>
                    <input type="radio" name="gender" id="male" value="male" <?= $gender_male ?>>
                    <label for="male">Male</label> &nbsp;
                    <input type="radio" name="gender" id="female" value="female" <?= $gender_female ?>>
                    <label for="male">Female</label>
                    <span class="error">* <?= $gender_err ?></span>
                </td>
            </tr>
            <tr>
                <td><label for="address">Address</label></td>
                <td>
                    <textarea name="address" id="address"><?= $address ?></textarea>
                </td>
            </tr>
            <tr>
                <td><label for="plan">Plan Type</label></td>
                <td>
                    <select name="plan" id="plan">
                        <option value="">-- select plan --</option>
                        <option value="free" <?= $plan_free ?>>Free</option>
                        <option value="professional" <?= $plan_pro ?>>Professional</option>
                        <option value="enterprise" <?= $plan_ent ?>>Enterprise</option>
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
                <td><input type="submit" name="submit" value="Submit">
                <input type="reset" name="reset" value="Reset"></td>
            </tr>
        </table>
    </form><br><br>
    
<?php if ($validated): ?>
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