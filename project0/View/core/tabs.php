<nav class="pt-3 nav nav-pills <?= $this->getAlignment() ?> text-center">
<?php 
$request = new Model_Core_Request();
$currentTabName = $request->getGet('tab', $this->getDefaultTab());
foreach ($this->getTabs() as $tab) {
    $active = $currentTabName == $tab['name'] ? 'active bg-dark text-light' : 'text-dark';
    $url = $tab['url'] ?? Model_Core_UrlManager::getUrl(null, null, ['tab' => $tab['name']]);
?>
    <a class="text-capitalize nav-link <?= $active ?>" href="#" onclick="mage.setUrl('<?= $url ?>').resetParams().load()"><?= $tab['name'] ?></a>
<?php } ?>
</nav>