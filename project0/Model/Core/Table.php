<?php

// require_once ROOT.'\\Model\\Core\\Adapter.php';

abstract class Model_Core_Table {
    protected $tableName = null;
    protected $primaryKey = null;
    protected $adapter = null;
    protected $data = [];

    protected function __construct() {
        $this->setAdapter();
    }

    public function save() {
        if (!array_key_exists($this->primaryKey, $this->data)) {
            // insert
            $sql = $this->buildQuery('insert');
            return $this->adapter->insert($sql);
        } else {
            // update
            $sql = $this->buildQuery('update');
            return $this->adapter->update($sql);
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
        $result = $this->adapter->fetchRow($sql);
        if (!$result) {
            throw new Exception("Data Load Failed.");
        }
        $this->setData($result);
        return $this;
    }

    public function fetchAll($sql) {
        $result = $this->adapter->fetchAll($sql);

        foreach ($result as &$record) {
            $record = (new $this())->setData($record);
        }
        return $result;
    }

    public function delete() {
        $sql = $this->buildQuery('delete');
        return $this->adapter->delete($sql);
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
        if (array_key_exists($this->primaryKey, $this->data))
            $this->{$this->primaryKey} = (int)($this->{$this->primaryKey});
        return $this;
    }

    public function getData() {
        return $this->data;
    }

    public function setAdapter($adapter = null) {
        if (!$adapter) {
            $adapter = new Model_Core_Adapter();
        }
        $this->adapter = $adapter;
        return $this;
    }

    public function getAdapter() {
        if (!$this->adapter) {
            $this->setAdapter();
        }
        return $this->adapter;
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