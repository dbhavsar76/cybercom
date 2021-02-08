<?php 

$current_file = pathinfo($_SERVER['REQUEST_URI'], PATHINFO_FILENAME);

?>

</body>
<!-- <script src="js/init.js"></script> -->
<script src="js/<?= $current_file ?>.js"></script>
</html>