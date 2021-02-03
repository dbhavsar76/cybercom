<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form 2</title>
    <link rel="stylesheet" href="form2.css">
</head>
<body>
<div class="wrapper">
<fieldset>
    <legend>User form</legend>
    <form action="<?= $self ?>" method="post" id="user-form">
        <table>
            <tbody>
            <tr>
                <td><label for="name">&bullet; First Name</label></td>
                <td>
                    <input type="text" name="name" id="name" value="<?= $name ?>" class="<?= $errors_cl[0] ?>">
                    <p class="err-msg"><?= $errors[0] ?></p>
                </td>
            </tr>
            <tr>
                <td><label for="password">&bullet; Password</label></td>
                <td>
                    <input type="password" name="password" id="password" value="<?= $pass ?>" class="<?= $errors_cl[1] ?>">
                    <p class="err-msg"><?= $errors[1] ?></p>
                </td>
            </tr>
            <tr>
                <td>&bullet; Gender</td>
                <td>
                    <input type="radio" name="gender" id="ge-m" value="male" class="<?= $errors_cl[2] ?>" <?= $male_checked ?>>
                    <label for="ge-m">Male</label>
                    <input type="radio" name="gender" id="ge-f" value="female" class="<?= $errors_cl[2] ?>" <?= $female_checked ?>>
                    <label for="ge-f">Female</label>
                    <p class="err-msg"><?= $errors[2] ?></p>
                </td>
            </tr>
            <tr>
                <td><label for="address">&bullet; Enter Address</label></td>
                <td>
                    <textarea name="address" id="address" class="<?= $errors_cl[3] ?>"><?= $address ?></textarea>
                    <p class="err-msg"><?= $errors[3] ?></p>
                </td>
            </tr>
            <tr>
                <td>&bullet; D.O.B.</td>
                <td>
                    <select name="dob-date" id="dob-date" class="<?= $errors_cl[4] ?>">
                        <option value="">Date</option>
<?php for ($i = 1; $i <= 31; $i++) {
                        $t = sprintf("%02d", $i);
                        $selected = ($dob_d == $t) ? 'selected' : '';
                        echo "<option value=\"$t\" $selected>$t</option>";
} ?>
                    </select>
                    <select name="dob-month" id="dob-month" class="<?= $errors_cl[4] ?>">
                    <option value="">Month</option>
<?php foreach ($months as $k => $val) {
                        $selected = ($dob_d == $t) ? 'selected' : '';
                    echo "<option value=\"$k\" $selected>$val</option>";
} ?>
                    </select>
                    <select name="dob-year" id="dob-year" class="<?= $errors_cl[4] ?>">
                        <option value="">Year</option>
<?php for ($i= 2020; $i > 1989; $i--) {
                        $selected = ($dob_y == $i) ? 'selected' : '';    
                        echo "<option value=\"$i\" $selected>$i</option>";
} ?>
                    </select>
                    <p class="err-msg"><?= $errors[4] ?></p>
                </td>
            </tr>
            <tr>
                <td>&bullet; Select Games</td>
                <td>
                    <input type="checkbox" name="game[]" id="g-hockey" value="hockey" class="<?= $errors_cl[5] ?>" <?= $games_checked[0] ?>>
                    <label for="g-hockey">Hockey</label>
                    <input type="checkbox" name="game[]" id="g-football" value="football" class="<?= $errors_cl[5] ?>" <?= $games_checked[1] ?>>
                    <label for="g-football">Football</label>
                    <input type="checkbox" name="game[]" id="g-cricket" value="cricket" class="<?= $errors_cl[5] ?>" <?= $games_checked[2] ?>>
                    <label for="g-cricket">Cricket</label>
                    <input type="checkbox" name="game[]" id="g-volleyball" value="volleyball" class="<?= $errors_cl[5] ?>" <?= $games_checked[3] ?>>
                    <label for="g-volleyball">Volleyball</label>
                    <p class="err-msg"><?= $errors[5] ?></p>
                </td>
            </tr>
            <tr>
                <td>&bullet; Marital Status</td>
                <td>
                    <input type="radio" name="m-status" id="ms-m" value="married" class="<?= $errors_cl[6] ?>" <?= $married_checked ?>>
                    <label for="ms-m">Married</label>
                    <input type="radio" name="m-status" id="ms-u" value="unmarried" class="<?= $errors_cl[6] ?>" <?= $unmarried_checked ?>>
                    <label for="ms-u">Unmarried</label>
                    <p class="err-msg"><?= $errors[6] ?></p>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" value="Submit" name="submit">
                    <input type="reset" value="Reset" name="reset">
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="checkbox" name="tnc" id="tnc" class="<?= $errors_cl[7] ?>">
                    <label for="tnc">I accept the agreement.</label>
                    <p class="err-msg"><?= $errors[7] ?></p>
                </td>
            </tr>
            </tbody>
        </table>
    </form>
</fieldset>
</div>
</body>
<script src="form2.js"></script>
</html>