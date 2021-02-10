<?php
// todo : add error handling with exceptions

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

    // params is an array so arr_of_param is an array of arrays
    // $no_of_params is the count of parameter set i.e. number of arrays in the $arr_of_param
    // public final function insert_multiple($sql, $param_types, $arr_of_param, $no_of_params) { 
    //     $params = array_fill(0, $no_of_params, '');
    //     $stmt = $this->con->prepare($sql);
    //     $stmt->bind_param()
    //     for ($i = 0; $i < $no_of_params; $i++) {
    //         $params = 
    //     }
    // }
    
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