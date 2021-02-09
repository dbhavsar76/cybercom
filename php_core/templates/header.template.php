<?php
// todo : create header and footer more generic and reusable : done

// create $header_build_context assoc array before including
// if same keys as default is set in the array then it will
// overwrite over the default value.

// put default or common elements directly in this file
// put dynamic content in build context

// default settings for header template
$default_header_build_context = [
    'title' => 'Web App',       // website title
    'default_css' => true,      // to enable css inclusion with file name
    'css_directory' => 'css/',  // '/' at the end is necessary, relative to base url
    'css_src' => []             // array of js files to include, paths relative to css_directory
];

// $bc (build context) : short name to embed in the html
if (isset($header_build_context)) {
    $bc = array_merge($default_header_build_context, $header_build_context);
} else {
    $bc = $default_header_build_context;
}


// create $no_default_css to stop from including css from file name
$current_file = pathinfo($_SERVER['REQUEST_URI'], PATHINFO_FILENAME);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $bc['title'] ?></title>
    <!-- put default css which are always included -->
    <link rel="stylesheet" href="<?= BASE_URL ?>css/common.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>css/nav.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!-- css to include from page name -->
    <?php if ($bc['default_css'] == true) : ?>
    <link rel="stylesheet" href="<?= BASE_URL.$bc['css_directory'].$current_file ?>.css">
    <?php endif ?>
    <!-- css from build context -->
    <?php foreach($bc['css_src'] as $file) : ?>
    <link rel="stylesheet" href="<?= BASE_URL.$bc['css_directory'].$file ?>">
    <?php endforeach ?>
</head>
<body>
<!-- insert header here -->
    <nav>
        <div class="nav-item title">WebApp</div>
        <div class="links">
            <div class="nav-item home"><a href="<?= BASE_URL ?>index.php"><span class="icon material-icons">home</span>Home</a></div>
            <div class="nav-item"><a href="<?= BASE_URL ?>contacts.php"><span class="icon material-icons">contacts</span>Contacts</a></div>
        </div>
    </nav>
<!-- end header -->