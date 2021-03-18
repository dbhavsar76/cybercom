<?php
use \Model\Core\UrlManager;

$cmsPage = $this->cmsPage;
$statusState = $this->statusState;
?>
<div class="form-group">
    <label for="title">Title</label>
    <input type="text" name="cmsPage[title]" id="title" class="form-control" value="<?= $cmsPage->title ?>">
</div>
<div class="form-group">
    <label for="identifier">Identifier <small>(Unique)</small></label>
    <input type="text" name="cmsPage[identifier]" id="identifier" class="form-control" value="<?= $cmsPage->identifier ?>">
</div>
<div class="form-group">
    <label for="cmsPageContent">Content</label>
    <textarea name="cmsPage[content]" id="cmsPageContent"><?= html_entity_decode($cmsPage->content) ?></textarea>
</div>
<div class="form-group">
    <div class="form-check">
        <input type="checkbox" name="cmsPage[status]" id="status" class="form-check-input" <?= $statusState ?>>
        <label for="status">Enabled</label>
    </div>
</div>
<script>
    $('#cmsPageContent').summernote();
</script>