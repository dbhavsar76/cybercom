<?php
namespace Controller\Core;

class Admin extends Base {
    public function __construct() {
        parent::__construct();
        $this->setMessageService(new \Model\Admin\Message);
        $this->setSession(new \Model\Admin\Session);
        $this->setLayout(new \Block\Admin\Layout);
        $this->setFilterService(new \Model\Admin\Filter);
    }

    public function filterAction() {
        try {
            $filterData = $this->getRequest()->getPost('filter');
            $filterService = $this->getFilterService();
            foreach ($filterData as $key => $vals) {
                $filterService->setFilter($key, $vals);
            }
        } catch (\Exception $e) {
            $this->getMessageService()->setFailure($e->getMessage());
        } finally {
            $this->gridAction();
        }
    }

}