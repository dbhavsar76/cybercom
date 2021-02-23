<nav class="navbar navbar-dark bg-dark navbar-expand">
    <div class="container-fluid">
        <a href="" class="navbar-brand">App</a>
        <ul class="navbar-nav">
            <li class="nav-item"><a href="<?= Model_Core_UrlManager::getUrl('dashboard', 'dashboard', null, true) ?>" class="nav-link active">Home</a></li>
            <li class="nav-item"><a href="<?= Model_Core_UrlManager::getUrl('grid', 'customer', null, true) ?>" class="nav-link">Customers</a></li>
            <li class="nav-item"><a href="<?= Model_Core_UrlManager::getUrl('grid', 'product', null, true) ?>" class="nav-link">Products</a></li>
            <li class="nav-item"><a href="<?= Model_Core_UrlManager::getUrl('grid', 'category', null, true) ?>" class="nav-link">Categories</a></li>
            <li class="nav-item"><a href="<?= Model_Core_UrlManager::getUrl('grid', 'paymentMethod', null, true) ?>" class="nav-link">Patment Methods</a></li>
            <li class="nav-item"><a href="<?= Model_Core_UrlManager::getUrl('grid', 'shippingMethod', null, true) ?>" class="nav-link">Shipping Methods</a></li>
        </ul>
    </div>
</nav>