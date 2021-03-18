<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/140c5d6dc2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?= BASE_URL ?>/skin/admin/summernote-0.8.18-dist/summernote-bs4.min.css">
</head>
<body class="d-flex flex-column" style="min-height: 100vh;">

<?php echo $this->getHeader()->render(); ?>

<div class="row mx-0 my-3">
    <section id="left" class="col-2">
    </section>
    <div id="mid" class="col-8">
        <section id="message">
        </section>
        <section id="content">
        </section>
    </div>
    <section id="right" class="col-2">
    </section>
</div>

<?php echo $this->getFooter()->render(); ?>

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