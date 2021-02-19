<?php

class Block_Product_Grid {
    private $template;

    public function setTemplate($template) {
        $this->template = $template;
        return $this;
    }

    public function getTemplate() {
        return $this->template;
    }

    public function render() {
        include $this->template;
    }
}
