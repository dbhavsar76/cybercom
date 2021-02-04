<?php
$find = ['fork', 'cook', 'bulb', 'birth'];
$replace = ['f**k', 'c**k', 'b**b', 'bi**h'];
$done = false;
if (isset($_GET['text']) && !empty($_GET['text'])) {
    $text = $_GET['text'];
    $count = 0;
    $text_censored = str_ireplace($find, $replace, $text, $count);
    $done = true;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Word Censoring</title>
</head>
<body>
    <form action="" method="get">
        <textarea name="text" id="texxt" cols="30" rows="10"></textarea>
        <br>
        <input type="submit" value="Submit">
    </form>
    <hr>
<?php
if ($done) {
    echo "Words censored : $count";
    echo '<br>';
    echo $text_censored;
}
?>
</body>
</html>