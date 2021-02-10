<?php

namespace Model;

class User {
    public $id;
    public $prefix;
    public $first_name;
    public $last_name;
    public $email;
    public $mobile;
    public $password;
    public $information;
    public $created;
    public $updated;
    public $last_login;

    public function __construct(
        $id=null,
        $prefix = null,
        $first_name = null,
        $last_name = null,
        $email = null,
        $mobile = null,
        $password = null,
        $information = null,
        $created = null,
        $updated = null,
        $last_login = null
        ) {
        $this->id = (int)$id;
        $this->prefix = $prefix;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->mobile = $mobile;
        $this->password = md5($password);
        $this->information = $information;
        $this->created = $created;
        $this->updated = $updated;
        $this->last_login = $last_login;
    }

    public function insert() {
        $db = new \DB;
        $sql = "INSERT INTO `user`(`prefix`,`first_name`,`last_name`,`email`,`mobile`,`password`,`information`) VALUES(?,?,?,?,?,?,?)";
        $param_types = "sssssss";
        $params = [$this->prefix, $this->first_name, $this->last_name, $this->email, $this->mobile, $this->password, $this->information];
        $inserted = $db->insert($sql, $param_types, $params);
        return $inserted;
    }

    public function select_this($mode='') {
        $db = new \DB;
        if ($mode == 'email') {
            $sql = "SELECT * FROM `user` WHERE `email`=?";
            $param_types = "s";
            $params = [$this->email];
        } else {
            $sql = "SELECT * FROM `user` WHERE `id`=?";
            $param_types = "i";
            $params = [$this->id];
        }
        $result_set = $db->select($sql, $param_types, $params);
        if (count($result_set) != 1) return false;
        return $result_set[0];
    }


    public function exists($mode = '') {
        $db = new \DB;
        if ($mode == 'update') {
            $sql = "SELECT `email`, FROM `user` WHERE `email`=? AND `id`!=?";
            $param_types = "si";
            $params = [$this->email, $this->id];
        } else {
            $sql = "SELECT `email` FROM `user` WHERE `email`=?";
            $param_types = "s";
            $params = [$this->email];
        }
        $result_set = $db->select($sql, $param_types, $params);
        if (count($result_set) > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function login() {
        $db = new \DB;
        $sql = "UPDATE `user` SET `last_login`=null WHERE `id`=?";
        $param_types = "i";
        $params = [$this->id];
        return $db->execute($sql, $param_types, $params);
    }

}