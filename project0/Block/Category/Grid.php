<?php
// require_once ROOT.'\\Block\\Core\\Base.php';
// require_once ROOT.'\\Model\\Category.php';

class Block_Category_Grid extends Block_Core_Base {
    public function __construct(Controller_Core_Base $controller) {
        $this->setTemplate(ROOT.'\\View\\category\\grid.php');
        $this->setController($controller);
        
        $this->categories = (new Model_Category)->load();
    } 
}