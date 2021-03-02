<nav class="pt-3 nav nav-pills <?= $this->getAlignment() ?> text-center">
<?php 
$request = new Model_Core_Request();
foreach ($this->getTabs() as $tab) {
    $active = $request->getGet('tab', $this->getDefaultTab()) == $tab ? 'active bg-dark text-light' : 'text-dark';
?>
    <a class="text-capitalize nav-link <?= $active ?>" href="<?= Model_Core_UrlManager::getUrl(null, null, ['tab' => $tab]) ?>"><?= $tab ?></a>
<?php } ?>
</nav>