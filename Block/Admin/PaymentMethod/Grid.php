<?php
namespace Block\Admin\PaymentMethod;
use Model\Core\UrlManager;
use Model\PaymentMethod;

class Grid extends \Block\Core\Grid {
    public function __construct() {
        parent::__construct();

        $this->prepareButtons();
        $this->prepareColumns();
        $this->prepareActions();
    }

    public function getTitle() {
        return 'Manage Payment Methods';
    }

    public function prepareCollection($filter = null, $sort = null) {
        if ($filter) {
            $this->setFilter($filter);
            $filterStrings = [];
            foreach ($filter as $key => $value) {
                $filterStrings[] = "`{$key}` = '{$value}'";
            }
            $filter = $filterStrings;
        }
        $this->setCollection((new PaymentMethod)->loadAll($filter, $sort));
        return $this;
    }

    public function prepareButtons() {
        $this->addButton('add', [
            'label' => 'Add Payment Method',
            'url'   => UrlManager::getUrl('add', null, null, true),
            'class' => 'btn-success',
            'ajax'  => true,
        ]);
        $this->addButton('filter', [
            'label' => 'Apply Filter',
            'type'  => 'submit',
            'form'  => '#filterForm',
            'ajax'  => true,
        ]);
        return $this;
    }

    public function prepareColumns() {
        $this->addColumn('id', [
            'label' => 'ID',
            'field' => 'id',
            'type'  => 'number',
        ]);
        $this->addColumn('name', [
            'label' => 'Name',
            'field' => 'name',
            'type'  => 'text',
        ]);
        $this->addColumn('code', [
            'label' => 'Code',
            'field' => 'code',
            'type'  => 'text',
        ]);
        $this->addColumn('createdDate', [
            'label' => 'Created Date',
            'field' => 'createdDate',
            'type'  => 'datetime',
        ]);
        $this->addColumn('status', [
            'label'  => 'Status',
            'field'  => 'status',
            'method' => 'getStatusUrl',
            'ajax'   => true,
            'type'   => 'select',
        ]);
        return $this;
    }

    public function prepareActions() {
        $this->addAction('edit', [
            'label'  => '<i class="fas fa-edit fa-fw"></i>',
            'method' => 'getEditUrl',
            'ajax'   => true
        ]);
        $this->addAction('delete', [
            'label'  => '<i class="fas fa-trash fa-fw"></i>',
            'class'  => 'btn-danger',
            'method' => 'getDeleteUrl',
            'ajax'   => true
        ]);
        return $this;
    }

    public function getEditUrl($row) {
        $pk = $row->getPrimaryKey();
        return UrlManager::getUrl('edit', null, [$pk => $row->$pk]);
    }

    public function getDeleteUrl($row) {
        $pk = $row->getPrimaryKey();
        return UrlManager::getUrl('delete', null, [$pk => $row->$pk]);
    }

    public function getStatusUrl($row, $column) {
        $class = $row->status == $row::STATUS_ENABLED ? 'btn-success' : 'btn-danger';
        $url = UrlManager::getUrl('toggleStatus', NULL, [$row->getPrimaryKey() => $row->{$row->getPrimaryKey()}]);
        if (!empty($column['ajax']) && $column['ajax']) {
            return "<a href=\"javascript:void(0);\" onclick=\"mage.setUrl('{$url}').resetParams().load()\" class=\"btn {$class} text-capitalize\">{$row->status}</a>";
        }
        return "<a href=\"{$url}\" class=\"btn {$class} text-capitalize\">{$row->status}</a>";
    }

}