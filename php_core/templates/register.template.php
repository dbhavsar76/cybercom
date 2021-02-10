<div class="wrapper">
    <h1>Register</h1>
    <form action="<?= BASE_URL ?>register.php" method="post">
        <div class="form-control">
            <label for="prefix">Prefix</label>
            <select name="prefix" id="prefix" class="<?= $errors['prefix'] ?>">
                <option value=""></option>
                <option value="Mr">Mr</option>
                <option value="Mrs">Mrs</option>
                <option value="Ms">Ms</option>
            </select>
            <div class="err-msg"><?= $errors['prefix'] ?></div>
        </div>
        <div class="form-control">
            <label for="first_name">First Name</label>
            <input type="text" name="first_name" id="first_name" class="<?= $err_class['first_name'] ?>" value="<?= $form_values['first_name'] ?>">
            <div class="err-msg"><?= $errors['first_name'] ?></div>
        </div>
        <div class="form-control">
            <label for="last_name">last Name</label>
            <input type="text" name="last_name" id="last_name" class="<?= $err_class['last_name'] ?>" value="<?= $form_values['last_name'] ?>">
            <div class="err-msg"><?= $errors['last_name'] ?></div>
        </div>
        <div class="form-control">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="<?= $err_class['email'] ?>" value="<?= $form_values['email'] ?>">
            <div class="err-msg"><?= $errors['email'] ?></div>
        </div>
        <div class="form-control">
            <label for="mobile">Mobile Number</label>
            <input type="tel" pattern="[0-9]{10}" name="mobile" id="mobile" class="<?= $err_class['mobile'] ?>" value="<?= $form_values['mobile'] ?>">
            <div class="err-msg"><?= $errors['mobile'] ?></div>
        </div>
        <div class="form-control">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="<?= $err_class['password'] ?>" value="<?= $form_values['password'] ?>">
            <div class="err-msg"><?= $errors['password'] ?></div>
        </div>
        <div class="form-control">
            <label for="password2">Confirm Password</label>
            <input type="password" name="password2" id="password2" class="<?= $err_class['password2'] ?>" value="<?= $form_values['password2'] ?>">
            <div class="err-msg"><?= $errors['password2'] ?></div>
        </div>
        <div class="form-control">
            <label for="information">Information</label>
            <textarea name="information" id="information" class="<?= $err_class['information'] ?>"><?= $form_values['information'] ?></textarea>
            <div class="err-msg"><?= $errors['information'] ?></div>
        </div>
        <div class="form-control">
            <input type="checkbox" name="tnc[]" id="tnc" class="<?= $err_class['tnc'] ?>">
            <label for="tnc">Hereby, I Accept the terms & conditions</label>
            <div class="err-msg"><?= $errors['tnc'] ?></div>
        </div>
        <div class="form-control">
            <input type="submit" value="Submit" name="submit">
        </div>
        <div class="err-msg"><?= $err_msg ?></div>

</form>
</div>