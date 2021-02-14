<?php

class DB {
    private $config = [
        'host' => 'localhost',
        'user' => 'dhrv',
        'pass' => 'q1w2e3r4',
        'dbname' => 'project0'
    ];
    private mysqli $con;

    public function __construct() {
        $this->setNewConnection();
    }

    public function getConnection() {
        return $this->con;
    }

    public function setNewConnection() {
        $this->con = new mysqli(
            $this->config['host'],
            $this->config['user'],
            $this->config['pass'],
            $this->config['dbname']
        );
    }

    public function setConfig(array $config) {
        if (!array_key_exists('host', $config) || !array_key_exists('user', $config) || !array_key_exists('pass', $config) || !array_key_exists('dbname', $config)) {
            return false;
        }

        $this->config = $config;
        return true;
    }

    public function fetchRow($sql) {
        if (!$this->con || $this->con->connect_errno === 0) {
            $this->setNewConnection();
        }

        $result = $this->con->query($sql);
        if (!$result || $result->num_rows === 0) return false;
        return $result->fetch_assoc();
    }

    public function fetchAll($sql) {
        if (!$this->con || $this->con->connect_errno === 0) {
            $this->setNewConnection();
        }

        $result = $this->con->query($sql);
        if (!$result || $result->num_rows === 0) return false;
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function insert($sql) {
        if (!$this->con || $this->con->connect_errno === 0) {
            $this->setNewConnection();
        }

        $result = $this->con->query($sql);
        if ($result) return $this->con->insert_id;
        return false;
    }

    public function update($sql) {
        return $this->insert($sql);
    }

    public function delete($sql) {
        if (!$this->con || $this->con->connect_errno === 0) {
            $this->setNewConnection();
        }

        return $this->con->query($sql);
    }
}