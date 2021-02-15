<?php
require_once ROOT.'\\Controller\\Core\\Base.php';

class Dashboard {
    public function dashboardAction() {
        include ROOT.'\\view\\header.php';
        include ROOT.'\\view\\dashboard\\dashboard.php';
        include ROOT.'\\view\\footer.php';
    }
}