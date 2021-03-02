<?php

class Model_Core_Adapter {
    // default configuration
    private $config = [
        'host' => 'localhost',
        'user' => 'dhrv',
        'pass' => 'q1w2e3r4',
        'dbname' => 'project0'
    ];
    private ?mysqli $con = null;

    private function isConnected() {
        return $this->con && !$this->con->connect_errno;
    }

    private function getConnection() {
        if (!$this->isConnected()) {
            $this->con = new mysqli(
                $this->config['host'],
                $this->config['user'],
                $this->config['pass'],
                $this->config['dbname']
            );
            if (!$this->isConnected()) {
                throw new Exception("Database Connection Error.");
            }
        }
        return $this->con;
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

    public function insert($sql) {
        $result = $this->getConnection()->query($sql);
        if (!$result) {
            return $result;
        }
        return $this->con->insert_id;
    }

    public function update($sql) {
        return $this->getConnection()->query($sql);
    }

    public function delete($sql) {
        return $this->getConnection()->query($sql);
    }
}