<div class="wrapper">
    <h1>Update Contact</h1>
    <hr>
    <form action="update.php" method="post">
        <div class="row">
            <div class="col">
                <label for="id">ID</label>
                <input type="number" name="id" id="id" value="<?= $form_values['id'] ?>" class="" placeholder="ID" readonly>
                <p class="err-msg"></p>
            </div>
            <div class="col">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="<?= $form_values['name'] ?>" class="<?= $err_class['name'] ?>" placeholder="John Doe">
                <p class="err-msg"><?= $errors['name'] ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="<?= $form_values['email'] ?>" class="<?= $err_class['email'] ?>" placeholder="johndoe@example.com">
                <p class="err-msg"><?= $errors['email'] ?></p>
            </div>
            <div class="col">
                <label for="id">Phone</label>
                <input type="number" name="phone" id="phone" value="<?= $form_values['phone'] ?>" class="<?= $err_class['phone'] ?>" placeholder="1234567890">
                <p class="err-msg"><?= $errors['phone'] ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="Title">Title</label>
                <input type="text" name="title" id="title" value="<?= $form_values['title'] ?>" class="<?= $err_class['title'] ?>" placeholder="Employee">
                <p class="err-msg"><?= $errors['title'] ?></p>
            </div>
            <div class="col">
                <label for="created">Created</label>
                <input type="datetime" name="created" id="created" value="<?= $form_values['created'] ?>" class="" placeholder="2021-01-01 01:01:01" readonly>
                <p class="err-msg"></p>
            </div>
        </div>
        <div class="row">
            <input type="submit" value="Update" name="submit">
            <div class="insert-err"><?= $err_msg ?></div>
        </div>
    </form>
</div>