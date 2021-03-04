<nav class="navbar navbar-dark bg-dark navbar-expand">
    <div class="container-fluid">
        <a href="" class="navbar-brand">App</a>
        <ul class="navbar-nav">
            <li class="nav-item"><a href="#" onclick="mage.setUrl('<?= Model_Core_UrlManager::getUrl('dashboard', 'dashboard', null, true) ?>').resetParams().load()" class="nav-link active">Home</a></li>
            <li class="nav-item"><a href="#" onclick="mage.setUrl('<?= Model_Core_UrlManager::getUrl('grid', 'admin', null, true) ?>').resetParams().load()" class="nav-link">Admins</a></li>
            <li class="nav-item"><a href="#" onclick="mage.setUrl('<?= Model_Core_UrlManager::getUrl('grid', 'customer', null, true) ?>').resetParams().load()" class="nav-link">Customers</a></li>
            <li class="nav-item"><a href="#" onclick="mage.setUrl('<?= Model_Core_UrlManager::getUrl('grid', 'customerGroup', null, true) ?>').resetParams().load()" class="nav-link">Customer Groups</a></li>
            <li class="nav-item"><a href="#" onclick="mage.setUrl('<?= Model_Core_UrlManager::getUrl('grid', 'product', null, true) ?>').resetParams().load()" class="nav-link">Products</a></li>
            <li class="nav-item"><a href="#" onclick="mage.setUrl('<?= Model_Core_UrlManager::getUrl('grid', 'category', null, true) ?>').resetParams().load()" class="nav-link">Categories</a></li>
            <li class="nav-item"><a href="#" onclick="mage.setUrl('<?= Model_Core_UrlManager::getUrl('grid', 'paymentMethod', null, true) ?>').resetParams().load()" class="nav-link">Payment Methods</a></li>
            <li class="nav-item"><a href="#" onclick="mage.setUrl('<?= Model_Core_UrlManager::getUrl('grid', 'shippingMethod', null, true) ?>').resetParams().load()" class="nav-link">Shipping Methods</a></li>
        </ul>
    </div>
</nav>