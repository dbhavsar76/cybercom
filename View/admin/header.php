<?php use Model\Core\UrlManager; ?>

<header>
    <nav class="navbar navbar-dark bg-dark navbar-expand">
        <div class="container-fluid">
            <a href="" class="navbar-brand">App</a>
            <ul class="navbar-nav">
                <li class="nav-item rounded active bg-secondary"><a href="javascript:void(0);" onclick="mage.setUrl('<?= UrlManager::getUrl('dashboard', 'admin_dashboard', null, true) ?>').resetParams().load()" class="nav-link">Home</a></li>
                <li class="nav-item rounded"><a href="javascript:void(0);" onclick="mage.setUrl('<?= UrlManager::getUrl('grid', 'admin_admin', null, true) ?>').resetParams().load()" class="nav-link">Admins</a></li>
                <li class="nav-item rounded"><a href="javascript:void(0);" onclick="mage.setUrl('<?= UrlManager::getUrl('grid', 'admin_customer', null, true) ?>').resetParams().load()" class="nav-link">Customers</a></li>
                <li class="nav-item rounded"><a href="javascript:void(0);" onclick="mage.setUrl('<?= UrlManager::getUrl('grid', 'admin_customer_Group', null, true) ?>').resetParams().load()" class="nav-link">Customer Groups</a></li>
                <li class="nav-item rounded"><a href="javascript:void(0);" onclick="mage.setUrl('<?= UrlManager::getUrl('grid', 'admin_brand', null, true) ?>').resetParams().load()" class="nav-link">Brands</a></li>
                <li class="nav-item rounded"><a href="javascript:void(0);" onclick="mage.setUrl('<?= UrlManager::getUrl('grid', 'admin_product', null, true) ?>').resetParams().load()" class="nav-link">Products</a></li>
                <li class="nav-item rounded"><a href="javascript:void(0);" onclick="mage.setUrl('<?= UrlManager::getUrl('grid', 'admin_category', null, true) ?>').resetParams().load()" class="nav-link">Categories</a></li>
                <li class="nav-item rounded"><a href="javascript:void(0);" onclick="mage.setUrl('<?= UrlManager::getUrl('grid', 'admin_paymentMethod', null, true) ?>').resetParams().load()" class="nav-link">Payment Methods</a></li>
                <li class="nav-item rounded"><a href="javascript:void(0);" onclick="mage.setUrl('<?= UrlManager::getUrl('grid', 'admin_shippingMethod', null, true) ?>').resetParams().load()" class="nav-link">Shipping Methods</a></li>
                <li class="nav-item rounded"><a href="javascript:void(0);" onclick="mage.setUrl('<?= UrlManager::getUrl('grid', 'admin_cmsPage', null, true) ?>').resetParams().load()" class="nav-link">CMS Pages</a></li>
                <li class="nav-item rounded"><a href="javascript:void(0);" onclick="mage.setUrl('<?= UrlManager::getUrl('grid', 'admin_entity_attribute', null, true) ?>').resetParams().load()" class="nav-link">Attributes</a></li>
            </ul>
        </div>
    </nav>
</header>
