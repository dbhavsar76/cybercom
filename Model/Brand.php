<?php
namespace Model;

class Brand extends Core\Table {
    public const STATUS_ENABLED = 'enabled';
    public const STATUS_DISABLED = 'disabled';

    public function __construct() {
        parent::__construct();

        $this->setTableName('brand');
        $this->setPrimaryKey('id');
    }

    public function getImageUrl() {
        return BASE_URL."/media/brand/{$this->{$this->getPrimaryKey()}}.png"; 
    }

    public function uploadImage($logo) {
        $path = ROOT.'/media/brand';
        if (!file_exists($path)) {
            mkdir($path);
        }

        $target = $path . '/' . $this->id . '.png';
        if (file_exists($target)) {
            unlink($target);
        }

        if (!@move_uploaded_file($logo['tmp_name'], $target)) {
            return false;
        }

        return true;
    }

    public function getProducts() {
        $id = $this->{$this->getPrimaryKey()};
        if (!$id) {
            return false;
        }
        return (new Product)->loadAll(["`brandId` = {$id}" ,'`status` = 1']);
    }
}