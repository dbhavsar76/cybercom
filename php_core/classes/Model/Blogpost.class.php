<?php

namespace Model;

class Blogpost {
    public $id;
    public $user_id;
    public $title;
    public $content;
    public $url;
    public $image;
    public $published;
    public $created;
    public $updated;

    public function __construct($id=null, $user_id=null, $title=null, $content=null, $url=null, $image=null, $published=null) {
        $this->id = (int)$id;
        $this->user_id = (int)$user_id;
        $this->title = $title;
        $this->content = $content;
        $this->url = $url;
        $this->image = $image;
        $this->published = $published;
    }

    public function insert($categories) {
        $db = new \DB;
        $sql = "INSERT INTO `blogpost`(`user_id`,`title`,`content`,`url`,`published`) VALUES(?,?,?,?,?)";
        $param_types = "issss";
        $params = [$this->user_id, $this->title, $this->content, $this->url, $this->published];
        $inserted = $db->insert($sql, $param_types, $params);
        
        $sql = "INSERT INTO `post_category`(`post_id`,`category_id`) VALUES(?,?)";
        $pid = (int)$inserted; $cid = 0;
        $param_types = "ii";
        foreach ($categories as $cat) {
            $cid = (int)$cat;
            $params = [$pid, $cid];
            $db->insert($sql, $param_types, $params);
        }
        return $inserted;
    }

    public function exists($mode='') {
        echo $mode, $this->id;
        $db = new \DB;
        if ($mode == 'edit') {
            $sql = "SELECT `id` FROM `blogpost` WHERE `url`=? and `id`!=?";
            $param_types = "si";
            $params = [$this->url, $this->id];
        } else {
            $sql = "SELECT `id` FROM `blogpost` WHERE `url`=?";
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

    public function update($categories) {
        $db = new \DB;
        $sql = "UPDATE `blogpost` SET `title`=?,`url`=?,`content`=?, `published`=?,`updated`=null WHERE `id`=?";
        $param_types = "ssssi";
        $params = [$this->title, $this->url, $this->content, $this->published, $this->id];
        $result = $db->execute($sql, $param_types, $params);

        $sql = "DELETE FROM `post_category` WHERE `post_id`=?";
        $param_types = "i";
        $params = [$this->id];
        $db->execute($sql, $param_types, $params);

        $sql = "INSERT INTO `post_category`(`post_id`,`category_id`) VALUES(?,?)";
        $pid = (int)$this->id; $cid = 0;
        $param_types = "ii";
        foreach ($categories as $cat) {
            $cid = (int)$cat;
            $params = [$pid, $cid];
            $db->insert($sql, $param_types, $params);
        }
        return $result;
    }

    public function delete() {
        $db = new \DB;
        $sql = "DELETE FROM `blogpost` WHERE `id`=?";
        $param_types = "i";
        $params = [$this->id];
        return $db->execute($sql, $param_types, $params);
    }

    public function select_this() {
        $db = new \DB;
        $sql = "SELECT * FROM `blogpost` WHERE `id`=?";
        $param_types = "i";
        $params = [$this->id];
        $result_set = $db->select($sql, $param_types, $params);
        if (count($result_set) != 1) return false;
        return $result_set[0];
    }

    // need to set user_id
    public static function select_all($user_id) {
        if (!$user_id) return [];
        $db = new \DB;
        $sql = "SELECT p.*, t.cat_ids, t.categories
                from blogpost p 
                left join (select pc.post_id, GROUP_CONCAT(pc.category_id) cat_ids, GROUP_CONCAT(c.title) categories from post_category pc left join category c on pc.category_id = c.id group by pc.post_id) t
                on p.id = t.post_id
                where p.user_id = ?";
        $param_types = "i";
        $params = [(int)$user_id];
        return $db->select($sql, $param_types, $params);
    }

}