<?php

require_once ROOT.'\\Model\\Core\\Adapter.php';

abstract class Model_Table {
    protected $tableName = null;
    protected $primaryKey = null;
    protected $data = [];

    protected function __construct() {}

    public function save() {
        $db = new Adapter();
        if (!array_key_exists($this->getPrimaryKey(), $this->getData())) {
            // insert
            $sql = $this->buildQuery('insert');
            return $db->insert($sql);
        } else {
            // update
            $sql = $this->buildQuery('update');
            return $db->update($sql);
        }
    }

    public function load($id = null) {
        if ($id) {
            $id = (int)$id;
            $sql = $this->buildQuery('select', $id);
            return $this->fetchRow($sql);
        }
        $sql = $this->buildQuery('selectAll');
        return $this->fetchAll($sql);
    }

    public function fetchRow($sql) {
        $db = new Adapter();
        $result = $db->fetchRow($sql);
        if (!$result) {
            throw new Exception("Data Load Failed.");
        }
        $this->setData($result);
        return $this;
    }

    public function fetchAll($sql) {
        $db = new Adapter();
        $reslutSet = [];
        $result = $db->fetchAll($sql);
        foreach ($result as $record) {
            $reslutSet[] = (new $this())->setData($record);
        }
        return $reslutSet;
    }

    public function delete() {
        $db = new Adapter();
        $sql = $this->buildQuery('delete');
        return $db->delete($sql);
    }

    public function buildQuery($type, $id=null) {
        switch (strtolower($type)) {
            case 'select':
                return "SELECT * FROM `{$this->getTableName()}` WHERE `{$this->getPrimaryKey()}`={$id}";
                break;

            case 'selectall':
                return "SELECT * FROM `{$this->getTableName()}`";
                break;

            case 'insert':
                $sql1 = "INSERT INTO `{$this->getTableName()}`(";
                $sql2 = 'VALUES (';
                $first = true;
                foreach ($this->getData() as $key => $value) {
                    if (!$first) {
                        $sql1 .= ',';
                        $sql2 .= ',';
                    }
                    $sql1 .= "`{$key}`";
                    $sql2 .= "'{$value}'";
                    $first = false;
                }
                return $sql1 . ') ' . $sql2 . ')';
                break;

            case 'update':
                $sql = "UPDATE `{$this->getTableName()}` SET ";
                $first = true;
                foreach ($this->getData() as $key => $value) {
                    if ($key === $this->getPrimaryKey()) {
                        continue;
                    }
                    if (!$first) {
                        $sql .= ', ';
                    }
                    if ($value === null)
                        $sql .= "`{$key}`=null";
                    else
                        $sql .= "`{$key}`='{$value}'";
                    $first = false;
                }
                $sql .= " WHERE `{$this->getPrimaryKey()}`={$this->{$this->getPrimaryKey()}}";
                return $sql;
                break;

            case 'delete':
                return "DELETE FROM `{$this->getTableName()}` WHERE `{$this->getPrimaryKey()}`={$this->{$this->getPrimaryKey()}}";
                break;
        } 
    }

    public function setPrimaryKey($keyname) {
        $this->primaryKey = $keyname;
    }

    public function getPrimaryKey() {
        return $this->primaryKey;
    }

    public function setTableName($name) {
        $this->tableName = $name;
    }

    public function getTableName() {
        return $this->tableName;
    }

    public function setData(array $data) {
        $this->data = array_merge($this->data, $data);
        if (array_key_exists($this->getPrimaryKey(), $this->data))
            $this->{$this->getPrimaryKey()} = (int)$this->{$this->getPrimaryKey()};
        return $this;
    }

    public function getData() {
        return $this->data;
    }

    public function __set($key, $value)
    {
        $this->data[$key] = $value;
        return $this;
    }

    public function __get($key)
    {
        if (!array_key_exists($key, $this->getData())) return null;
        return $this->data[$key];
    }

}