<div class="wrapper">
    <h1>Log In</h1>
    <form action="<?= BASE_URL.'login.php' ?>" method="post">
        <div class="form-control">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="<?= $err_class['email'] ?>" value="<?= $form_values['email'] ?>">
            <div class="err-msg"><?= $errors['email'] ?></div>
        </div>
        <div class="form-control">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="<?= $err_class['password'] ?>">
            <div class="err-msg"><?= $errors['password'] ?></div>
        </div>
        <div class="form-control">
            <input class="btn" type="submit" value="Log In" name="submit">
            <a class="btn" href="<?= BASE_URL ?>register.php">Register</a>
        </div>
        <div class="err-msg"><?= $err_msg ?></div>
    </form>
</div>