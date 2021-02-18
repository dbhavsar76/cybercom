<section>
<div class="container-fluid">
    <p class="h2 mt-3"><?= $formMode ?>Customer</p>
    <hr class="hr-dark">
    <form action="<?= $formAction ?>" method="post" class="col-lg-6">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="firstName">First Name</label>
                    <input type="text" name="firstName" id="firstName" class="form-control" value="<?= $firstName ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="lastName">Last Name</label>
                    <input type="text" name="lastName" id="lastName" class="form-control" value="<?= $lastName ?>">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="<?= $email ?>">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" value="<?= $password ?>">
        </div>
        <div class="form-group">
            <label for="password2">Confirm Password</label>
            <input type="password" name="password2" id="password2" class="form-control" value="<?= $password2 ?>">
        </div>
        <div class="from-group">
            <button type="submit" id="submit-btn" class="btn btn-primary"><?= $formMode ?> Customer</button>
<?php if ($formMode == 'add') : ?>
            <button type="reset" id="reset-btn" class="btn btn-secondary ml-2">Reset</button>
<?php else : ?>
            <a class="btn btn-secondary text-white ml-2">Cancel</a>
<?php endif ?>
        </div>
    </form>
</div>
</section>