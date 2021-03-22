<?php
namespace Model\Admin;

class Filter extends Session {
    public function setFilter($key, $vals) {
        $vals = array_filter($vals);

        $filter = $this->filter ?? [];
        $filter[$key] = $vals;
        $this->filter = $filter;
        return $this;
    }

    public function getFilter($key) {
        if ($this->filter && array_key_exists($key, $this->filter)) {
            return $this->filter[$key];
        }
        return null;
    }

    public function getFilterStrings($key) {
        if ($this->filter && array_key_exists($key, $this->filter)) {
            $filter = $this->filter[$key];
            $filterStrings = [];
            foreach ($filter as $field => $value) {
                $filterStrings[] = "`{$field} LIKE '%{$value}%'`";
            }
            return $filterStrings;
        }
        return null;
    }
}