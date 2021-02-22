<?php
// require_once ROOT.'\\Controller\\Core\\Base.php';
// require_once ROOT.'\\Block\\Header.php';
// require_once ROOT.'\\Block\\Footer.php';
// require_once ROOT.'\\Block\\Dashboard\\Dashboard.php';

class Controller_Dashboard extends Controller_Core_Base {
    public function dashboardAction() {
        $headerBlock = new Block_Header($this);
        $dashboardBlock = new Block_Dashboard_Dashboard($this);
        $footerBlock = new Block_Footer($this);

        $headerBlock->render();
        $dashboardBlock->render();
        $footerBlock->render();
    }
}