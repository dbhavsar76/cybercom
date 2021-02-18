<?php

class Adapter {
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
            if (!$this->isConnected()) throw new Exception("Database Connection Error.");
        }
        return $this->con;
    }

    public function fetchRow($sql) {
        if (!$this->isConnected()) {
            $this->getConnection();
        }

        $result = $this->con->query($sql);
        if (!$result || $result->num_rows === 0) return false;
        return $result->fetch_assoc();
    }

    public function fetchAll($sql) {
        if (!$this->con || $this->con->connect_errno) {
            $this->getConnection();
        }

        $result = $this->con->query($sql);
        if (!$result) return false;
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function insert($sql) {
        if (!$this->con || $this->con->connect_errno) {
            $this->getConnection();
        }

        $result = $this->con->query($sql);
        if (!$result) return false;
        return $this->con->insert_id;
    }

    public function update($sql) {
        if (!$this->con || $this->con->connect_errno) {
            $this->getConnection();
        }

        return $this->con->query($sql);
    }

    public function delete($sql) {
        if (!$this->isConnected()) {
            $this->getConnection();
        }

        return $this->con->query($sql);
    }

    public function getEscapedString($str) {
        if (!$this->isConnected()) {
            $this->getConnection();
        }

        return $this->con->real_escape_string($str);
    }
}