<?php

namespace Model;

class Category {
    public $id;
    public $parent_id;
    public $title;
    public $meta_title;
    public $url;
    public $content;

    public function __construct($id=null,$parent_id=null, $title=null, $meta_title=null, $url=null, $content=null) {
        $this->id = (int)$id;
        $this->parent_id = (int)$parent_id;
        $this->title = $title;
        $this->meta_title = $meta_title;
        $this->url = $url;
        $this->content = $content;
    }

    public function insert() {
        $db = new \DB;
        $sql = "INSERT INTO `category`(`parent_id`,`title`,`meta_title`,`url`,`content`) VALUES(?,?,?,?,?)";
        $param_types = "issss";
        $params = [$this->parent_id, $this->title, $this->meta_title, $this->url, $this->content];
        return  $db->insert($sql, $param_types, $params);
    }

    public function update() {
        $db = new \DB;
        $sql = "UPDATE `category` SET `parent_id`=?,`title`=?,`meta_title`=?,`url`=?,`content`=?, `updated`=null WHERE `id`=?";
        $param_types = "issssi";
        $params = [$this->parent_id, $this->title, $this->meta_title, $this->url, $this->content, $this->id];
        return  $db->execute($sql, $param_types, $params);
    }

    public function delete() {
        $db = new \DB;
        $sql = "DELETE FROM `category` WHERE `id`=?";
        $param_types = "i";
        $params = [$this->id];
        return $db->execute($sql, $param_types, $params);
    }

    public function exists($mode='') {
        echo $mode, $this->id;
        $db = new \DB;
        if ($mode == 'edit') {
            $sql = "SELECT `id` FROM `category` WHERE `url`=? and `id`!=?";
            $param_types = "si";
            $params = [$this->url, $this->id];
        } else {
            $sql = "SELECT `id` FROM `category` WHERE `url`=?";
            $param_types = "s";
            $params = [$this->url];
        }
        $result_set = $db->select($sql, $param_types, $params);
        if (count($result_set) > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function select_this() {
        $db = new \DB;
        $sql = "SELECT * FROM `category` WHERE `id`=?";
        $param_types = "i";
        $params = [$this->id];
        $result_set = $db->select($sql, $param_types, $params);
        if (count($result_set) != 1) return false;
        return $result_set[0];
    }

    public static function select_all() {
        $db = new \DB;
        $sql = "SELECT * FROM `category`";
        return $db->select($sql);
    }
}