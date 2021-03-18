<?php #useless file : queue for removal ?>

<script src="<?= BASE_URL ?>/skin/admin/js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="<?= BASE_URL ?>/skin/admin/summernote-0.8.18-dist/summernote.min.js"></script>
<script src="<?= BASE_URL ?>/skin/admin/js/mage.js"></script>
<script>
    let layout = 'threeColumn';
    const mage = new Base();

    $(document).ready(function() {
        mage.setUrl('<?= \Model\Core\UrlManager::getUrl('dashboard', 'admin_dashboard') ?>').load();

        $('header .nav-item').click(function(e) {
            $('header .nav-item').removeClass('active bg-secondary');
            $(this).addClass('active bg-secondary');
        });
    });
</script>
</body>
</html>