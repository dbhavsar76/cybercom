<div class="wrapper">
    <h1><?= $h1 ?></h1>
    <form action="<?= BASE_URL.$self ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $form_values['id'] ?>">
        <div class="form-control">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="<?= $err_class['title'] ?>" value="<?= $form_values['title'] ?>">
            <div class="err-msg"><?= $errors['title'] ?></div>
        </div>
        <div class="form-control">
            <label for="content">Content</label>
            <textarea name="content" id="content" class="<?= $err_class['content'] ?>" ><?= $form_values['content'] ?></textarea>
            <div class="err-msg"><?= $errors['content'] ?></div>
        </div>
        <div class="form-control">
            <label for="url">Url</label>
            <input type="text" name="url" id="url" class="<?= $err_class['url'] ?>" value="<?= $form_values['url'] ?>">
            <div class="err-msg"><?= $errors['url'] ?></div>
        </div>
        <div class="form-control">
            <label for="published">Published At</label>
            <input type="date" name="published" id="published" class="<?= $err_class['published'] ?>" value="<?= $form_values['published'] ?>">
            <div class="err-msg"><?= $errors['published'] ?></div>
        </div>
        <div class="form-control">
            <label for="cateory">Category</label>
            <select name="category[]" id="cateory" class="<?= $err_class['cateory'] ?>" multiple>
<?php  foreach ($categories as $category) {
                if (array_search($category['id'], $form_values['category'])) {
                    $selected = 'selected';
                } else $selected = '';

?>
                <option value="<?= $category['id'] ?>" <?= $selected ?>><?= $category['title'] ?></option>
<?php } ?>
            </select>
            <div class="err-msg"><?= $errors['category'] ?></div>
        </div>
        <div class="form-control">
            <label for="image">Image</label>
            <input type="file" name="image" id="image" class="<?= $err_class['image'] ?>" value="<?= $form_values['image'] ?>">
            <div class="err-msg"><?= $errors['image'] ?></div>
        </div>
        <div class="form-control">
            <input class="btn" type="submit" value="Submit" name="submit">
        </div>
    </form>
</div>