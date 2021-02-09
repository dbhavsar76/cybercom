<?php

namespace Model;

use DateTimeImmutable;
use DateTimeZone;

class Contact {
    public $id;
    public $name;
    public $email;
    public $phone;
    public $title;
    public $created;

    function __construct($id = null, $name = null, $email = null, $phone = null, $title = null, $created = null) {
        $this->id = (int)$id;
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->title = $title;
        $this->created = $created;
    }

    public function selectThis() {
        $db = new \DB;
        $sql = "SELECT * FROM `contacts` WHERE `id`=?";
        $param_types = "i";
        $params = [$this->id];
        $result_set = $db->select($sql, $param_types, $params);
        if (count($result_set) != 1) return false;
        return $result_set[0];
    }

    public function insert() {
        $created = (new DateTimeImmutable('now', new DateTimeZone('+0530')))->format('Y-m-d H:i:s');
        $db = new \DB;
        $sql = "INSERT INTO `contacts`(`name`,`email`,`phone`,`title`, `created`) VALUES(?,?,?,?,?)";
        $param_types = "sssss";
        $params = [$this->name, $this->email, $this->phone, $this->title, $created];
        $inserted = $db->insert($sql, $param_types, $params);
        return $inserted;
    }

    public function update() {
        $db = new \DB;
        $sql = "UPDATE `contacts` SET `name`=?, `email`=?, `phone`=?, `title`=? WHERE `id`=?";
        $param_types = "ssssi";
        $params = [$this->name, $this->email, $this->phone, $this->title, $this->id];
        return $db->execute($sql, $param_types, $params);
    }

    public function delete() {
        $db = new \DB;
        $sql = "DELETE FROM `contacts` WHERE `id`=?";
        $param_types = "i";
        $params = [$this->id];
        return $db->execute($sql, $param_types, $params);
    }

    public function exists($mode = '') {
        $db = new \DB;
        if ($mode == 'update') {
            $sql = "SELECT `email` FROM `contacts` WHERE `email`=? AND `id`!=?";
            $param_types = "si";
            $params = [$this->email, $this->id];
        } else {
            $sql = "SELECT `email` FROM `contacts` WHERE `email`=?";
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

    public static function selectAll() {
        $db = new \DB;
        $sql = "SELECT * FROM `contacts`";
        return $db->select($sql);
    }
}