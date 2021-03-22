<?php
namespace Model\Core;

abstract class Table {
    private $tableName = null;
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
            $result = $this->adapter->insert($sql);
        } else {
            // update
            $sql = $this->buildQuery('update');
            $result = $this->adapter->update($sql);
        }
        if (!$result) {
            return false;
        }
        return $result;
    }

    public function load($id = null, $conditions = null) {
        if (!$id && $this->id) {
            $id = $this->id;
            $id = (int)$id;
        }
        if (!$id && !$conditions) {
            return false;
        }
        $sql = $this->buildQuery('select', $id, $conditions);
        $result = $this->fetchRow($sql);
        if ($result === false) {
            return false;
        }
        $this->setData($result);
        return $this;
    }

    public function loadAll($conditions = null, $orderBy = null, $limit = null) {
        $sql = $this->buildQuery('selectAll', null, $conditions, $orderBy, $limit);
        $modelClassName = get_class($this);
        $collectionName = substr_replace($modelClassName, '\\Collection\\', strpos($modelClassName, '\\'), 1);
        $result = $this->fetchAll($sql);
        if ($result === false) {
            return $result;
        }
        return (new $collectionName($result));
    }

    public function fetchRow($sql) {
        return $this->adapter->fetchRow($sql);
    }

    public function fetchAll($sql) {
        return $this->adapter->fetchAll($sql);
    }

    public function delete() {
        $sql = $this->buildQuery('delete');
        return $this->adapter->delete($sql);
    }

    public function buildQuery($type, $id=null, $conditions = null, $orderBy = null, $limit = null) {
        $sql = '';
        switch (strtolower($type)) {
            case 'select':
                if ($id) {
                    if (!$conditions) {
                        $conditions = [];
                    }
                    array_unshift($conditions, "`{$this->primaryKey}`={$id}");
                }
                $sql = "SELECT * FROM `{$this->tableName}` WHERE " . implode(' AND ', $conditions);
                break;

            case 'selectall':
                $sql = "SELECT * FROM `{$this->tableName}`";
                if (!empty($conditions)) {
                    $sql .= " WHERE " . implode(" AND ", $conditions);
                }
                if (!empty($orderBy)) {
                    $sql .= " ORDER BY " . implode(", ", $orderBy);
                }
                if (!empty($limit)) {
                    $sql .= " LIMIT {$limit}";
                }
                break;

            case 'insert':
                $sql1 = "INSERT INTO `{$this->tableName}`(";
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
                $sql = $sql1 . ') ' . $sql2 . ')';
                break;

            case 'update':
                $sql = "UPDATE `{$this->tableName}` SET ";
                $first = true;
                foreach ($this->data as $key => $value) {
                    if ($key === $this->primaryKey) {
                        continue;
                    }
                    if (!$first) {
                        $sql .= ', ';
                    }
                    if ($value === null) {
                        $sql .= "`{$key}`=null";
                    } else {
                        $sql .= "`{$key}`='{$value}'";
                    }
                    $first = false;
                }
                $sql .= " WHERE `{$this->primaryKey}`={$this->{$this->primaryKey}}";
                break;

            case 'delete':
                $sql = "DELETE FROM `{$this->tableName}` WHERE `{$this->primaryKey}`={$this->{$this->primaryKey}}";
                break;

            default:
        }
        return $sql;
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
        return $this;
    }

    public function resetData() {
        $this->data = [];
        return $this;
    }

    public function getData() {
        return $this->data;
    }

    public function setAdapter($adapter = null) {
        if (!$adapter) {
            $adapter = new Adapter();
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
        if (!array_key_exists($key, $this->data)) {
            return null;
        }
        return $this->data[$key];
    }

    public function __isset($key) {
        return array_key_exists($key, $this->data);
    }

    public function getRow() {
        return clone $this;
    }
}