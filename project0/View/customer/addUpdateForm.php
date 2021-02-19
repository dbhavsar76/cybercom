<section>
<div class="container-fluid">
    <p class="h2 mt-3"><?= $formMode ?>Customer</p>
    <hr class="hr-dark">
    <form action="<?= $formAction ?>" method="post" class="col-lg-6">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="firstName">First Name</label>
                    <input type="text" name="customer[firstName]" id="firstName" class="form-control" value="<?= $customer->firstName ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="lastName">Last Name</label>
                    <input type="text" name="customer[lastName]" id="lastName" class="form-control" value="<?= $customer->lastName ?>">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="customer[email]" id="email" class="form-control" value="<?= $customer->email ?>">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="customer[password]" id="password" class="form-control">
        </div>
        <div class="form-group">
            <label for="password2">Confirm Password</label>
            <input type="password" name="customer[password2]" id="password2" class="form-control">
        </div>
        <div class="from-group">
            <button type="submit" id="submit-btn" class="btn btn-primary"><?= $formMode ?> Customer</button>
            <a href="<?= $this->getUrl('grid', null, null, true) ?>" class="btn btn-secondary text-white ml-2">Cancel</a>
        </div>
    </form>
</div>
</section>