<?php
namespace Block\Admin\Entity\Attribute;

use Model\Core\UrlManager;
use Model\Entity\Attribute;

class Grid extends \Block\Core\Grid {
    public function __construct() {
        parent::__construct();

        $attribute = (new Attribute);
        $this->entityMapping = (new \Model\Entity\Type)->getMapping();
        $this->inputTypes = $attribute->getInputTypeOptions();
        $this->backendTypes = $attribute->getBackendTypeOptions();
        $this->prepareButtons();
        $this->prepareColumns();
        $this->prepareActions();
    }

    public function getTitle() {
        return 'Manage Attributes';
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
        $this->setCollection((new Attribute)->loadAll($filter, $sort));
        return $this;
    }

    public function prepareButtons() {
        $this->addButton('add', [
            'label' => 'Add Attribute',
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
            'field' => 'attributeId',
            'type'  => 'number',
        ]);
        $this->addColumn('entityType', [
            'label' => 'Entity Type',
            'method' => 'getEntityType',
            'field' => 'entityTypeId',
            'type'  => 'text',
        ]);
        $this->addColumn('name', [
            'label' => 'Name',
            'field' => 'name',
            'type'  => 'text',
        ]);
        $this->addColumn('inputType', [
            'label' => 'Input Type',
            'method' => 'getInputType',
            'field' => 'inputTypeId',
            'type'  => 'text',
        ]);
        $this->addColumn('backendType', [
            'label' => 'Backend Type',
            'method' => 'getBackendType',
            'field' => 'backendType',
            'type'  => 'text',
        ]);
        $this->addColumn('backendModel', [
            'label' => 'Backend Model',
            'field' => 'backendModel',
            'type'  => 'text',
        ]);
        $this->addColumn('code', [
            'label' => 'Code',
            'field' => 'code',
            'type'  => 'text',
        ]);
        $this->addColumn('sortOrder', [
            'label' => 'Sort Order',
            'field' => 'sortOrder',
            'type'  => 'number',
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

    public function getEntityType($row) {
        return $this->entityMapping[$row->entityTypeId];
    }

    public function getInputType($row) {
        return $this->inputTypes[$row->inputTypeId];
    }

    public function getBackendType($row) {
        return $this->backendTypes[$row->backendType];
    }
}