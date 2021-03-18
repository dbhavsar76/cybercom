<?php

use Model\Core\UrlManager;
?>
<div id="header-top" class="container-fluid px-0 bg-white">
    <div class="px-5 bg-secondary">
        &nbsp;
    </div>
    <nav class="primaryNavbar px-5 navbar navbar-expand navbar-light justify-content-between bg-white">
        <a href="<?= BASE_URL ?>" class="navbar-brand h1">App</a>
        <form class="form-inline col-6 my-2 my-lg-0" id="searchForm" >
            <div class="input-group w-100">
                <input class="form-control border-primary" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-search fa-fw" aria-hidden="true"></i></button>
                </div>
            </div>
        </form>
        <div class="navbar-nav">
            <a href="#" class="btn btn-light"><i class="fa fa-user fa-fw" aria-hidden="true"></i> User</a>
            <a href="#" class="btn btn-light ml-3"> <i class="fa fa-shopping-cart fa-fw" aria-hidden="true"></i> Cart</a>
        </div>
    </nav>
    <nav class="deptNavbar px-5 navbar navbar-expand bg-white justify-content-center border-top border-bottom border-dark">
        <ul class="nav navbar-nav">
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" id="c1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Category 1</a>
                <div class="dropdown-menu" aria-labelledby="c1">
                    <a href="#" class="dropdown-item">Sub Cat 1</a>
                    <a href="#" class="dropdown-item">Sub Cat 1</a>
                    <a href="#" class="dropdown-item">Sub Cat 1</a>
                    <a href="#" class="dropdown-item">Sub Cat 1</a>
                </div>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">Category 1</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">Category 1</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">Category 1</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">Category 1</a>
            </li>
        </ul>
    </nav>
</div>