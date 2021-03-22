<!DOCTYPE html>
<html lang="en">

<?php include ROOT.'/View/head.php'; ?>

<body class="d-flex flex-column bg-light" style="min-height: 100vh;">

<?php echo $this->getHeader()->render(); ?>

<div class="row mx-0 my-3">
    <section id="left" class="col-2">
    </section>
    <div id="mid" class="col-8">
        <section id="message">
        </section>
        <section id="content">
        <?= $this->getContent()->render() ?>
        </section>
    </div>
    <section id="right" class="col-2">
    </section>
</div>

<?php echo $this->getFooter()->render(); ?>

<?php include ROOT.'/View/tail.php' ?>
</body>
</html>