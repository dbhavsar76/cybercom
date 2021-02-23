<?php

class Controller_Dashboard extends Controller_Core_Base {
    public function dashboardAction() {
        try {
            $layout = $this->getLayout();
            $layout->prepareChildren(Block_Core_Layout::LAYOUT_ONE_COLUMN);
            $layout->getChild('header')->addChild(new Block_Header);
            $layout->getChild('content')->addChild(new Block_Dashboard_Dashboard);
            $layout->getChild('footer')->addChild(new Block_Footer);

            $layout->render();
        } catch (Exception $e) {
            echo $e->getMessage().' in '.__METHOD__;
        }
    }
}