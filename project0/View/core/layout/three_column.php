<?php
include ROOT.'/View/core/start.php';
echo $this->getChild('header')->render();
?>
<div class="row mx-0 my-3">
    <section id="left" class="col-2">
        <?= $this->getChild('left')->render() ?>
    </section>
    <div id="mid" class="col-8">
        <section id="message">
        </section>
        <section id="content">
            <?= $this->getChild('content')->render() ?>
        </section>
    </div>
    <section id="right" class="col-2">
        <?= $this->getChild('right')->render() ?>
    </section>
</div>
<?php
echo $this->getChild('footer')->render();
include ROOT.'/View/core/end.php';
?>
