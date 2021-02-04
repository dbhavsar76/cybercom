<?php
$text_new = $find = $replcae = '';
$msg = '';
$count = 0;

if (isset($_POST['submit'])) {
    if (!empty($_POST['text']) && !empty($_POST['find']) && !empty($_POST['replace'])) {
        $text = $_POST['text'];
        $find = trim($_POST['find']);
        $replace = trim($_POST['replace']);
        $text_new = str_ireplace($find, $replace, $text, $count);
        $msg = "Number of words replaced : $count";
    } else {
        $msg = 'Please fill in all fields.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find and Replace</title>
</head>
<body>
    <form action="" method="post">
        <label for="text">Enter Text Here :</label><br>
        <textarea name="text" id="text" cols="30" rows="7"><?= $text_new ?></textarea><br><br>
        <label for="find">Find :</label><br>
        <input type="text" name="find" id="find" value="<?= $find ?>"><br><br>
        <label for="replace">Replace With :</label><br>
        <input type="text" name="replace" id="replace" value="<?= $replace ?>"><br><br>
        <input type="submit" value="submit" name="submit">
    </form>
    <?= $msg ?>
</body>
</html>