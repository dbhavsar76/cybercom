<?php
// todo : add exception throwing on errors

class DB {
    private const HOST = 'localhost';
    private const USER = 'dhrv';
    private const PASS = 'q1w2e3r4';
    private const DATABASE = 'php_core_test';
    private $con;

    function __construct() {
        $this->con = new mysqli(self::HOST, self::USER, self::PASS, self::DATABASE);
        if ($this->con->connect_errno) {
            trigger_error("Database Connection Error ({$this->con->connect_errorno}) : {$this->con->connect_error}", E_USER_ERROR);
        }
    }

    public final function insert($sql, $param_types, $params) {
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param($param_types, ...$params);
        $stmt->execute();
        return $this->con->insert_id;
    }

    public final function select($sql, $param_types = '', $params = []) {
        $stmt = $this->con->prepare($sql);
        
        if (!empty($param_types) && !empty($params)) {
            $stmt->bind_param($param_types, ...$params);
        }

        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // for update and delete
    public final function execute($sql, $param_types = "", $params = []) {
        $stmt = $this->con->prepare($sql);
        
        if (!empty($param_types) && !empty($params)) {
            $stmt->bind_param($param_types, ...$params);
        }
        // echo $this->con->error;
        return $stmt->execute();
    }

    function __destruct() {
        $this->con->close();
    }
}