<div>
<?= $this->getBlock('home_banner')->render() ?>
<?= $this->getBlock('home_slider')->prepareDeals()->render();?>
<?= $this->getBlock('home_slider')->preparePopular()->render();?>
<?= $this->getBlock('home_brands')->render() ?>
</div>
