<?php 
// todo : create header and footer more generic and reusable : done

// create $footer_build_context assoc array before including
// if same keys as default is set in the array then it will
// overwrite over the default value.

// default settings for footer template
$default_footer_build_context = [
    'default_js' => true,       // to enable js inclusion with file name
    'js_directory' => 'js/',    // '/' at the end is necessary
    'js_src' => []              // array of js files to include
];

// $bc (build context) : short name to embed in the html
if (isset($footer_build_context)) {
    $bc = array_merge($default_footer_build_context, $footer_build_context);
} else {
    $bc = $default_footer_build_context;
}

$current_file = pathinfo($_SERVER['REQUEST_URI'], PATHINFO_FILENAME);
?>

<!-- insert website footer here -->
<!-- end footer -->
</body>
<?php if ($bc['default_js'] == true) : ?>
<script src="<?= BASE_URL.$bc['js_directory'].$current_file ?>.js"></script>
<?php endif ?>
<?php foreach ($bc['js_src'] as $file): ?>
<script src="<?= BASE_URL.$bc['js_directory'].$file ?>"></script>
<?php endforeach ?>
</html>