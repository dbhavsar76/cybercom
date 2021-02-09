<?php 

$current_file = pathinfo($_SERVER['REQUEST_URI'], PATHINFO_FILENAME);

?>

</body>
<!-- <script src="js/init.js"></script> -->
<?php if (!isset($no_js) || $no_js == false) : ?>
<script src="js/<?= $current_file ?>.js"></script>
<?php endif ?>
</html>