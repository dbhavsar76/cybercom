<?php
namespace Model\Product;

class Media extends \Model\Core\Table {
    public const IS_SMALL = 1;
    public const IS_NOT_SMALL = 0;
    public const IS_THUMB = 1;
    public const IS_NOT_THUMB = 0;
    public const IS_BASE = 1;
    public const IS_NOT_BASE = 0;
    public const GALLERY_SHOW = 1;
    public const GALLERY_HIDE = 0;

    public function __construct() {
        parent::__construct();
        $this->setTableName('product_media');
        $this->setPrimaryKey('id');
    }

    public function getUrl() {
        return BASE_URL . "/media/product/{$this->productId}/{$this->id}.png";
    }

    public function saveStates($productId, $smallId = null, $thumbId = null, $baseId = null, $galleryIds = null) {
        if (is_null($smallId) && is_null($thumbId) && is_null($baseId) && is_null($galleryIds)) {
            return false;
        }
        $sql = "UPDATE `{$this->getTableName()}` SET ";
        if (!empty($smallId)) {
            $sql .= "`small` = IF(`{$this->getPrimaryKey()}`='{$smallId}', 1, 0), ";
        }
        if (!empty($thumbId)) {
            $sql .= "`thumb` = IF(`{$this->getPrimaryKey()}`='{$thumbId}', 1, 0), ";
        }
        if (!empty($baseId)) {
            $sql .= "`base` = IF(`{$this->getPrimaryKey()}`='{$baseId}', 1, 0), ";
        }
        if (!is_null($galleryIds)) {
            $ids = implode(',', $galleryIds);
            $sql .= "`gallery` = IF(`{$this->getPrimaryKey()}` IN (-1,{$ids}), 1, 0) ";
        }
        $sql .= " WHERE `productId`='{$productId}'";
        return $this->adapter->update($sql);
    }

    public function remove($imageIds, $productId) {
        $ids = implode(',', $imageIds);
        $sql = "DELETE FROM `{$this->getTableName()}` WHERE `productId`={$productId} AND `id` IN ({$ids})";
        return $this->adapter->delete($sql);
    }
}