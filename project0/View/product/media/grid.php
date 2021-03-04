<div class="d-flex align-items-center justify-content-between mb-3">
    <p class="h2 d-inline">Product Media</p>
    <form id="imageUploadForm" action="<?= Model_Core_UrlManager::getUrl('upload') ?>" method="post" enctype="multipart/form-data" class="form-inline d-flex-inline">
        <div class="form-group">
            <div class="custom-file">
                <input class="custom-file-input" type="file" name="image" id="image-upload" accept="image/*">
                <label class="custom-file-label" for="image-upload">Choose Image File</label>
            </div>
        </div>
        <div class="form-group ml-3">
            <a class="btn btn-primary" href="#" onclick="mage.setForm('#imageUploadForm').load()">Upload</a>
        </div>
    </form>
</div>
<hr class="hr-dark">
<div class="row m-0">
<?php foreach ($this->images as $imageUrl) { 
    $imageName = pathinfo($imageUrl, PATHINFO_BASENAME);
?>
    <div class="col-3 p2">
        <div class="card">
            <img src="<?= $imageUrl ?>" alt="<?= $imageName ?>" class="card-img">
            <div class="card-img-overlay">
                <a href="#" onclick="mage.setUrl('<?= Model_Core_UrlManager::getUrl('delete', NULL, ['imageName' => $imageName]) ?>').resetParams().load()" class="btn btn-danger float-right"><i class="fas fa-trash fa-fw"></i></a>
            </div>
        </div>
    </div>
<?php } ?>
</div>