<?php
use Model\Core\UrlManager;
use Model\Product\Media;

$media = $this->media;
?>
<div class="d-flex align-items-center justify-content-between mb-3">
    <p class="h2 mb-0">Product Media</p>
    <form id="imageUploadForm" action="<?= UrlManager::getUrl('upload') ?>" method="post" enctype="multipart/form-data" class="form-inline d-flex-inline">
        <div class="form-group">
            <div class="custom-file">
                <input class="custom-file-input" type="file" name="image" id="image-upload" accept="image/*">
                <label class="custom-file-label justify-content-start" for="image-upload" style="text-overflow: ellipsis; white-space:nowrap;">Choose Image File</label>
            </div>
        </div>
        <div class="form-group ml-3">
            <a class="btn btn-primary" href="javascript:void(0);" onclick="mage.setForm('#imageUploadForm').load()">Upload</a>
        </div>
    </form>
</div>
<script type="application/javascript">
    $('#image-upload').change(function(e){
        let fileName = e.target.files[0]?.name;
        $('.custom-file-label').html(fileName != undefined ? fileName : 'Choose Image File');
    });
</script>
<hr class="hr-dark">
<div class="container">
    <form id="mediaForm" action="<?= UrlManager::getUrl('update') ?>">
        <div class="mb-2 d-flex justify-content-end">
            <a class="btn btn-primary" href="javascript:void(0);" onclick="mage.setForm('#mediaForm').load()">Update</a>
            <a class="btn btn-danger ml-3" href="javascript:void(0);" onclick="mage.setForm('#mediaForm').setUrl('<?= UrlManager::getUrl('remove') ?>').load()">Remove</a>
        </div>
        <table class="table table-stripped">
            <thead>
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Label</th>
                    <th scope="col">Small</th>
                    <th scope="col">Thumb</th>
                    <th scope="col">Base</th>
                    <th scope="col">Gallery</th>
                    <th scope="col">Remove</th>
                </tr>
            </thead>
            <tbody>
            <?php if ($media->count() == 0) : ?>
                <tr>
                    <td class="text-center" colspan="7">No Records Found.</td>
                </tr>
            <?php else : ?>
                <?php
                $primaryKey = (new Media)->getPrimaryKey();
                foreach ($media as $image) :
                    $id = $image->$primaryKey;
                ?>
                <tr>
                    <td><img src="<?= $image->getUrl() ?>" alt="<?= $id ?>" height="100px" width="100px"></td>
                    <td class="label-container"> <input class="form-control" type="text" name="label[<?= $id ?>]" value="<?= $image->label ?>" disabled> </td>
                    <td class="text-center"> <input type="radio" name="small" value="<?= $id ?>" <?= $image->small == Media::IS_SMALL ? 'checked' : '' ?>> </td>
                    <td class="text-center"> <input type="radio" name="thumb" value="<?= $id ?>" <?= $image->thumb == Media::IS_THUMB ? 'checked' : '' ?>> </td>
                    <td class="text-center"> <input type="radio" name="base" value="<?= $id ?>" <?= $image->base == Media::IS_BASE ? 'checked' : '' ?>> </td>
                    <td class="text-center"> <input type="checkbox" name="gallery[]" value="<?= $id ?>" <?= $image->gallery == Media::GALLERY_SHOW ? 'checked' : '' ?>> </td>
                    <td class="text-center"> <input type="checkbox" name="remove[]" value="<?= $id ?>"> </td>
                </tr>
                <?php endforeach ?>
            <?php endif ?>
            </tbody>
        </table>
    </form>
    <script>
        $('.label-container').on('dblclick', function(e) {
            $(this).children('input[type="text"]').removeAttr('disabled');
        });
    </script>
</div>