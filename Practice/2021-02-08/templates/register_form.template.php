<h1>Registration Form</h1>
<form action="<?= $self ?>" method="post">
    <div class="form-control">
        <label for="name">Name : </label>
        <input type="text" name="name" id="name" placeholder="Name" class="<?= $err_class[0] ?>" value="<?= $form_values['name'] ?>">
        <p class="err-msg"><?= $errors[0] ?></p>
    </div>
    <div class="form-control">
        <label for="email">Email : </label>
        <input type="email" name="email" id="email" placeholder="E-mail" class="<?= $err_class[1] ?>" value="<?= $form_values['email'] ?>">
        <p class="err-msg"><?= $errors[1] ?></p>
    </div>
    <div class="form-control">
        <label for="password">Password : </label>
        <input type="password" name="password" id="password" placeholder="Password" class="<?= $err_class[2] ?>" value="<?= $form_values['password'] ?>">
        <p class="err-msg"><?= $errors[2] ?></p>
    </div>
    <div class="form-control">
        <label for="password2">Confirm Password : </label>
        <input type="password" name="password2" id="password2" placeholder="Confirm Password" class="<?= $err_class[3] ?>" value="<?= $form_values['password2'] ?>">
        <p class="err-msg"><?= $errors[3] ?></p>
    </div>
    <div class="form-control">
        <label for="birthdate">Birthdate : </label>
        <input type="date" name="birthdate" id="birthdate" class="<?= $err_class[4] ?>" value="<?= $form_values['birthdate'] ?>">
        <p class="err-msg"><?= $errors[4] ?></p>
    </div>
    <div class="form-control">
        <input type="submit" value="Submit" name="submit" id="submit-btn">
        <input type="reset" value="Reset">
    </div>
    <div class="msg"><?= $msg ?></div>
</form>