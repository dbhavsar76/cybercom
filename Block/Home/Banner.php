<?php
namespace Block\Home;

class Banner extends \Block\Core\Template {
    protected $banners = []; // contains url to images (for now)

    public function __construct() {
        parent::__construct();
        $this->setTemplate('/home/banner.php');
        $this->prepareBanners();
    }

    public function setBanners($banners) {
        $this->banners = $banners;
        return $this;
    }

    public function getBanners() {
        return $this->banners;
    }

    public function prepareBanners() {
        $bannerUrls = [];
        $dir = ROOT.'/media/banner/';
        if (is_dir($dir)) {
            $directoryHandle = opendir($dir);
            while (($file = readdir($directoryHandle)) !== false) {
                if (!is_file($dir . $file)) {
                    continue;
                }
                $bannerUrls[] = BASE_URL . '/media/banner/' . $file;
            }
        }
        $this->setBanners($bannerUrls);
        return $this;
    }
}