<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/140c5d6dc2.js" crossorigin="anonymous"></script>
</head>
<body class="d-flex flex-column" style="min-height: 100vh;">
<header>
    <nav class="navbar navbar-dark bg-dark navbar-expand">
    <div class="container-fluid">
        <a href="" class="navbar-brand">App</a>
        <ul class="navbar-nav">
            <li class="nav-item"><a href="<?= $this->getUrl('dashboard', 'dashboard', null, true) ?>" class="nav-link active">Home</a></li>
            <li class="nav-item"><a href="<?= $this->getUrl('grid', 'customer', null, true) ?>" class="nav-link">Customers</a></li>
            <li class="nav-item"><a href="<?= $this->getUrl('grid', 'product', null, true) ?>" class="nav-link">Products</a></li>
            <li class="nav-item"><a href="<?= $this->getUrl('grid', 'category', null, true) ?>" class="nav-link">Categories</a></li>
            <li class="nav-item"><a href="<?= $this->getUrl('grid', 'paymentMethod', null, true) ?>" class="nav-link">Patment Methods</a></li>
            <li class="nav-item"><a href="<?= $this->getUrl('grid', 'shippingMethod', null, true) ?>" class="nav-link">Shipping Methods</a></li>
        </ul>
    </div>
    </nav>
</header>