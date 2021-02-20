<?php

class Model_Core_Request {
    public function isPost() {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    public function getGet($key = null, $default = null) {
        if (!$key) {
            return $_GET;
        }
        if (!array_key_exists($key, $_GET)) {
            return $default;
        }
        return $_GET[$key];
    }

    public function getPost($key = null, $default = null) {
        if (!$key) {
            return $_POST;
        }
        if (!array_key_exists($key, $_POST)) {
            return $default;
        }
        return $_POST[$key];
    }

}