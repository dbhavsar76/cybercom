<?php
namespace Model\Core;

class Response {
    private $responseData = [];

    public function setStatus($status) {
        $this->responseData['status'] = $status;
        return $this;
    }

    public function setLayout($layout) {
        $this->responseData['layout'] = $layout;
        return $this;
    }

    public function addElement($selector, $html) {
        $this->responseData['element'][] = [
            'selector' => $selector,
            'html' => $html
        ];
        return $this;
    }

    public function setAjaxRedirect($url) {
        $this->responseData['ajaxRedirect'] = $url;
        return $this;
    }

    public function send() {
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($this->responseData);
        /* exit(0); */
    }
}