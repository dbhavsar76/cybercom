<?php
namespace Block\Core;

use Model\Core\Collection;
use Model\Core\UrlManager;

class Grid extends Template {
    protected $collection = null;
    protected $buttons = [];
    protected $columns = [];
    protected $actions = [];
    protected $filter = [];
    
    public function __construct() {
        parent::__construct();
        $this->setTemplate('/core/grid.php');
    }

    public function getFormUrl() {
        return UrlManager::getUrl('filter');
    }

    public function setFilter($filter) {
        $this->filter = $filter;
        return $this;
    }

    public function getFilter() {
        return $this->filter;
    }

    public function getCollection() {
        return $this->collection;
    }

    public function setCollection($collection) {
        $this->collection = $collection;
        return $this;
    }

    public function prepareCollection($filter = null) {
        $this->setCollection(new Collection());
        return $this;
    }

    public function getButtons() {
        return $this->buttons;
    }

    public function addButton($key, $button) {
        $this->buttons[$key] = $button;
        return $this;
    }

    public function getButtonUrl($button) {
        $buttonHtml = "";
        $buttonClass = $button['class'] ?? 'btn-primary';
        # ajax buttons
        if (!empty($button['ajax']) && $button['ajax']) {
            if (!empty($button['type']) && $button['type'] == 'submit') {
                $buttonHtml = "<a href=\"javascript:void(0);\" onclick=\"mage.resetParams().setForm('{$button['form']}').load()\" class=\"btn {$buttonClass}\">{$button['label']}</a>";
            } else {
                $buttonHtml = "<a href=\"javascript:void(0);\" onclick=\"mage.setUrl('{$button['url']}').resetParams().load()\" class=\"btn {$buttonClass}\">{$button['label']}</a>";
            }
        }   # php buttons 
        else {
            if (!empty($button['type']) && $button['type'] == 'submit') {
                $buttonHtml = "<button type=\"submit\" class=\"btn {$buttonClass}\">{$button['label']}</button>";
            } else {
                $buttonHtml = "<a href=\"{$button['url']}\" class=\"{$buttonClass}\">{$button['label']}</a>";
            }
        }
        return $buttonHtml;
    }

    public function prepareButtons() {
        return $this;
    }

    public function getColumns() {
        return $this->columns;
    }

    public function prepareColumns() {
        return $this;
    }

    public function addColumn($key, $column) {
        $this->columns[$key] = $column;
        return $this;
    }

    public function getValue($row, $column) {
        if (empty($column['method'])) {
            $field = $column['field'];
            return $row->$field;
        }
        $method = $column['method'];
        return $this->$method($row, $column);
    }

    public function getActions() {
        return $this->actions;
    }

    public function prepareActions() {
        return $this;
    }

    public function addAction($key, $action) {
        $this->actions[$key] = $action;
        return $this;
    }

    public function getActionUrl($action, $row) {
        $method = $action['method'];
        $actionClass = $action['class'] ?? 'btn-primary';
        if ($action['ajax']) {
            return "<a href=\"javascript:void(0);\" onclick=\"mage.setUrl('{$this->$method($row)}').resetParams().load()\" class=\"btn {$actionClass}\">{$action['label']}</a>";
        }
        return "<a href=\"{$action->$method($row)}\" class=\"{$actionClass}\">{$action['label']}</a>";
    }

    public function getTitle() {
        return "Manage Module";
    }

    public function getFilterStrings($filter) {
        $filterStrings = [];
        foreach ($filter as $field => $value) {
            $filterStrings[] = "`{$field} LIKE '%{$value}%'`";
        }
        return $filterStrings;
    }

}