<?php
require_once ROOT.'\\Controller\\Core\\Base.php';

class Controller_Dashboard extends Controller_Core_Base {
    public function dashboardAction() {
        include ROOT.'\\view\\header.php';
        include ROOT.'\\view\\dashboard\\dashboard.php';
        include ROOT.'\\view\\footer.php';
    }
}