<?php use \Model\Core\UrlManager; ?>

<nav id="tabs"  class="pt-3 nav nav-pills <?= $this->getAlignment() ?> text-center">
<?php
foreach ($this->getTabs() as $tab) {
    $url = $tab['url'] ?? UrlManager::getUrl('tab', null, ['tab' => $this->prepareName($tab['name'])]);
?>
    <a class="text-capitalize nav-link" href="#" onclick="mage.setUrl('<?= $url ?>').resetParams().load()"><?= $tab['name'] ?></a>
<?php } ?>
<script>
    $('#tabs .nav-link').on('click', function(event) {
        $('#tabs .nav-link').removeClass('active bg-dark text-light').addClass('text-dark');
        $(this).removeClass('text-dark').addClass('active bg-dark text-light');
    });

    $('#tabs .nav-link').first().click();
</script>
</nav>