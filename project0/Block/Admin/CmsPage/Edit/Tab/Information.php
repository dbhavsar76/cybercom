<?php
namespace Block\Admin\CmsPage\Edit\Tab;

class Information extends \Block\Core\Template {
    public function __construct(int $id = null) {
        parent::__construct();
        $this->setTemplate('/admin/cms_page/edit/tab/information.php');

        $cmsPage = new \Model\CmsPage();
        if ($id && !$cmsPage->load($id)) {
            throw new \Exception('Id not found.');
        }
        $this->cmsPage = $cmsPage;
        $this->statusState = $cmsPage->status == \Model\CmsPage::STATUS_DISABLED ? '' : 'checked';
    }
}