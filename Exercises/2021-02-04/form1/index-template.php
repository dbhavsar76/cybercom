<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form 1</title>
    <link rel="stylesheet" href="form1.css">
</head>
<body>
<div class="wrapper">
    <form action="<?= $self ?>" method="post" enctype="multipart/form-data" id="user-form">
        <table>
            <thead>
                <tr>
                    <th colspan="2" scope="colgroup">User Form</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><label for="name">Enter Name</label></td>
                    <td>
                        <input type="text" name="name" id="name" value="<?= $name ?>" class="<?= $errors_cl[0] ?>">
                        <p class="err-msg"><?= $errors[0] ?></p>
                    </td>
                </tr>
                <tr>
                    <td><label for="password">Enter Password</label></td>
                    <td>
                        <input type="password" name="password" id="password" class="<?= $errors_cl[1] ?>">
                        <p class="err-msg"><?= $errors[1] ?></p>
                    </td>
                </tr>
                <tr>
                    <td><label for="address">Enter Address</label></td>
                    <td>
                        <textarea name="address" id="address" class="<?= $errors_cl[2] ?>"><?= $address ?></textarea>
                        <p class="err-msg"><?= $errors[2] ?></p>
                    </td>
                </tr>
                <tr>
                    <td>Select Game</td>
                    <td>
<?php foreach ($games_a as $i => $game) : ?>
                        <input type="checkbox" name="game[]" id="g-<?= $game ?>" value="<?= $game ?>" <?= $games_checked[$i] ?> class="<?= $errors_cl[3] ?>">
                        <label for="g-<?= $game ?>"><?= $game ?></label><br>
<?php endforeach ?>
                        <p class="err-msg"><?= $errors[3] ?></p>
                    </td>
                </tr>
                <tr>
                    <td>Gender</td>
                    <td>
                        <input type="radio" name="gender" id="ge-m" value="male" <?= $male_checked ?> class="<?= $errors_cl[4] ?>">
                        <label for="ge-m">Male</label>
                        <input type="radio" name="gender" id="ge-f" value="female" <?= $female_checked ?> class="<?= $errors_cl[4] ?>">
                        <label for="ge-f">Female</label>
                        <p class="err-msg"><?= $errors[4] ?></p>
                    </td>
                </tr>
                <tr>
                    <td>Age Group</td>
                    <td>
                        <select name="age-grp" id="age-grp" class="<?= $errors_cl[5] ?>">
                            <option value="">Select</option>
<?php for ($i = 1; $i <= 10; $i++) {
                        $l = ($i-1)*10;
                        $h = $l + 9;
                        $selected = ($age_grp == $i) ? 'selected' : '';
                        echo "<option value=\"$i\" $selected>$l - $h</option>";
} ?>
                        </select>
                        <p class="err-msg"><?= $errors[5] ?></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="file" name="image" id="img-upload" class="<?= $errors_cl[6] ?>">
                        <p class="err-msg"><?= $errors[6] ?></p>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2">
                        <input type="reset" value="Reset" name="reset" id="reset">
                        <input type="submit" value="Submit Form" name="submit" id="submit">
                    </td>
                </tr>
            </tfoot>
        </table>
    </form>
    <div class="sub"><?= $submit_msg ?></div>
</div>
</body>
<script src="form1.js"></script>
</html>