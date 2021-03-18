<?php
namespace Model\Core;

class Adapter {
    // default configuration
    private $config = [
        'host' => 'localhost',
        'user' => 'dhrv',
        'pass' => 'q1w2e3r4',
        'dbname' => 'project0'
    ];
    private static ?\mysqli $con = null;

    private function isConnected() {
        return static::$con && !static::$con->connect_errno;
    }

    private function getConnection() {
        if (!$this->isConnected()) {
            static::$con = new \mysqli(
                $this->config['host'],
                $this->config['user'],
                $this->config['pass'],
                $this->config['dbname']
            );
            if (!$this->isConnected()) {
                throw new \Exception("Database Connection Error.");
            }
        }
        return static::$con;
    }

    public function fetchRow($sql) {
        $result = $this->getConnection()->query($sql);
        if (!$result) {
            return $result;
        }
        return $result->fetch_assoc();
    }

    public function fetchAll($sql) {
        $result = $this->getConnection()->query($sql);
        if (!$result) {
            return $result;
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function fetchOne($sql) {
        $result = $this->getConnection()->query($sql);
        if (!$result) {
            return $result;
        }
        $result = $result->fetch_row();
        return $result[0];
    }

    public function fetchPairs($sql) {
        $result = $this->getConnection()->query($sql);
        if (!$result) {
            return $result;
        }
        $result = $result->fetch_all();
        $pairs = [];
        foreach ($result as $record) {
            $pairs[$record[0]] = $record[1];
        }
        return $pairs;

    }

    public function insert($sql) {
        $result = $this->getConnection()->query($sql);
        if (!$result) {
            return $result;
        }
        return $this->getConnection()->insert_id;
    }

    public function update($sql) {
        return $this->getConnection()->query($sql);
    }

    public function delete($sql) {
        return $this->getConnection()->query($sql);
    }
}