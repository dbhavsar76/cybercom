<?php
namespace Model\Core;

class Session {
    protected $nameSpace = 'core';

    public function __construct() {
        $this->start();
    }

    public function start() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return $this;
    }

    public function destroy() {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_destroy();
        }
        return $this;
    }

    public function getId() {
        return session_id();
    }

    public function regenerateId() {
        return session_regenerate_id();
    }

    public function __set($key, $value) {
        $_SESSION[$this->nameSpace][$key] = $value;
        return $this;
    }

    public function __get($key) {
        if (array_key_exists($key, $_SESSION[$this->nameSpace])) {
            return $_SESSION[$this->nameSpace][$key];
        }
        return null;
    }

    public function __unset($key) {
        if (array_key_exists($key, $_SESSION[$this->nameSpace])) {
            unset($_SESSION[$this->nameSpace][$key]);
        }
        return $this;
    }

    public function setNameSpace(string $nameSpace) {
        $this->nameSpace = $nameSpace;
        return $this;
    }

    public function getNameSpace() {
        return $this->nameSpace;
    }
}