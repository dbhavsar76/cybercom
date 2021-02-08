<?php

class DB {
    private const HOST = 'localhost';
    private const USER = 'dhrv';
    private const PASS = 'q1w2e3r4';
    private const DATABASE = 'test';
    private $con;

    function __construct() {
        $this->con = new mysqli(self::HOST, self::USER, self::PASS, self::DATABASE);
        if ($this->con->connect_errno) {
            trigger_error("Database Connection Error ({$this->con->connect_errorno}) : {$this->con->connect_error}");
        }
    }

    public function insert($sql, $param_types, $params) {
        $stmt = $this->con->prepare($sql);
        if (!$stmt) {
            trigger_error("Prepare Failed ({$this->con->errorno}) : {$this->con->error}", E_USER_ERROR);
        }
        
        if (!$stmt->bind_param($param_types, ...$params)) {
            trigger_error("Bind Failed ({$this->con->errorno}) : {$this->con->error}", E_USER_ERROR);
        }

        if (!$stmt->execute()) {
            trigger_error("Execute Failed ({$this->con->errorno}) : {$this->con->error}", E_USER_ERROR);
        }

        return $this->con->insert_id;
    }

    public function select($sql, $param_types = '', $params = []) {
        $stmt = $this->con->prepare($sql);
        if (!$stmt) {
            trigger_error("Prepare Failed ({$this->con->errorno}) : {$this->con->error}", E_USER_ERROR);
        }
        
        if (!empty($param_types) && !empty($params)) {
            if (!$stmt->bind_param($param_types, ...$params)) {
                trigger_error("Bind Failed ({$this->con->errorno}) : {$this->con->error}", E_USER_ERROR);
            }
        }

        if (!$stmt->execute()) {
            trigger_error("Execute Failed ({$this->con->errorno}) : {$this->con->error}", E_USER_ERROR);
        }

        $result_set = [];
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $result_set = $result->fetch_all(MYSQLI_ASSOC);
        }

        return $result_set;
    }

    function __destruct() {
        $this->con->close();
    }
}