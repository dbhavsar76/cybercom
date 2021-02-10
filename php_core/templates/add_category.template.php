<div class="wrapper">
    <h1><?= $h1 ?></h1>
    <form action="<?= BASE_URL.$self ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $form_values['id']?>">
        <div class="form-control">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="<?= $err_class['title'] ?>" value="<?= $form_values['title'] ?>">
            <div class="err-msg"><?= $errors['title'] ?></div>
        </div>
        <div class="form-control">
            <label for="content">content</label>
            <textarea name="content" id="content" class="<?= $err_class['content'] ?>" ><?= $form_values['content'] ?></textarea>
            <div class="err-msg"><?= $errors['content'] ?></div>
        </div>
        <div class="form-control">
            <label for="url">url</label>
            <input type="text" name="url" id="url" class="<?= $err_class['url'] ?>" value="<?= $form_values['url'] ?>">
            <div class="err-msg"><?= $errors['url'] ?></div>
        </div>
        <div class="form-control">
            <label for="meta_title">Meta Title</label>
            <input type="text" name="meta_title" id="meta_title" class="<?= $err_class['meta_title'] ?>" value="<?= $form_values['meta_title'] ?>">
            <div class="err-msg"><?= $errors['meta_title'] ?></div>
        </div>
        <div class="form-control">
            <label for="parent_id">Parent Category</label>
            <select name="parent_id" id="parent_id" class="<?= $err_class['parent_id'] ?>">
                <option value="0"></option>
<?php foreach($categories as $category) { 
    $checked = $category['id'] == $form_values['parent_id'] ? 'selected' : '';    
?>
                <option value="<?= $category['id']?>" <?= $checked ?>><?= $category['title'] ?></option>
<?php } ?>
            </select>
            <div class="err-msg"><?= $errors['parent_id'] ?></div>
        </div>
        <div class="form-control">
            <label for="image">image</label>
            <input type="file" name="image" id="image" class="<?= $err_class['image'] ?>" value="<?= $form_values['image'] ?>">
            <div class="err-msg"><?= $errors['image'] ?></div>
        </div>
        <div class="form-control">
            <input type="submit" value="Submit" name="submit">
        </div>
    </form>
</div>