<?php
namespace Block\Admin\CmsPage;

class Grid extends \Block\Core\Template {
    public function __construct() {
        parent::__construct();
        $this->setTemplate('/admin/cms_page/grid.php');
        
        $cmsPage = new \Model\CmsPage;
        $this->cmsPages = $cmsPage->loadAll();
    } 
}