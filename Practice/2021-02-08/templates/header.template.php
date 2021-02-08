<?php 
// if (!isset($header_context)) {
//     $header_context = [
//         'title' => 'Landing Page',
//         'stylesheets' => ['style.css'],
//         'stylesheet_dir' => 'css',
//     ];
// }
$current_file = pathinfo($_SERVER['REQUEST_URI'], PATHINFO_FILENAME);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web App</title>
    <!-- <link rel="stylesheet" href="css/common.css"> -->
    <link rel="stylesheet" href="css/<?= $current_file ?>.css">
</head>
<body>
