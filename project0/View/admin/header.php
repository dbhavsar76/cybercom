<?php use Model\Core\UrlManager; ?>

<nav class="navbar navbar-dark bg-dark navbar-expand">
    <div class="container-fluid">
        <a href="" class="navbar-brand">App</a>
        <ul class="navbar-nav">
            <li class="nav-item rounded active bg-secondary"><a href="#" onclick="mage.setUrl('<?= UrlManager::getUrl('dashboard', 'dashboard', null, true) ?>').resetParams().load()" class="nav-link">Home</a></li>
            <li class="nav-item rounded"><a href="#" onclick="mage.setUrl('<?= UrlManager::getUrl('grid', 'admin', null, true) ?>').resetParams().load()" class="nav-link">Admins</a></li>
            <li class="nav-item rounded"><a href="#" onclick="mage.setUrl('<?= UrlManager::getUrl('grid', 'customer', null, true) ?>').resetParams().load()" class="nav-link">Customers</a></li>
            <li class="nav-item rounded"><a href="#" onclick="mage.setUrl('<?= UrlManager::getUrl('grid', 'customer\\Group', null, true) ?>').resetParams().load()" class="nav-link">Customer Groups</a></li>
            <li class="nav-item rounded"><a href="#" onclick="mage.setUrl('<?= UrlManager::getUrl('grid', 'product', null, true) ?>').resetParams().load()" class="nav-link">Products</a></li>
            <li class="nav-item rounded"><a href="#" onclick="mage.setUrl('<?= UrlManager::getUrl('grid', 'category', null, true) ?>').resetParams().load()" class="nav-link">Categories</a></li>
            <li class="nav-item rounded"><a href="#" onclick="mage.setUrl('<?= UrlManager::getUrl('grid', 'paymentMethod', null, true) ?>').resetParams().load()" class="nav-link">Payment Methods</a></li>
            <li class="nav-item rounded"><a href="#" onclick="mage.setUrl('<?= UrlManager::getUrl('grid', 'shippingMethod', null, true) ?>').resetParams().load()" class="nav-link">Shipping Methods</a></li>
            <li class="nav-item rounded"><a href="#" onclick="mage.setUrl('<?= UrlManager::getUrl('grid', 'cmsPage', null, true) ?>').resetParams().load()" class="nav-link">CMS Pages</a></li>
        </ul>
    </div>
</nav>