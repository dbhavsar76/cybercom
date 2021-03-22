<?php
namespace Model\Customer;

class Filter extends Session {
    public function setFilter($key, $vals) {
        foreach ($vals as $field => $val) {
            if (empty($val)) {
                unset($vals[$field]);
            }
        }

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
}