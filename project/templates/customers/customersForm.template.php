<section>
<div class="container-fluid">
    <p class="h2 mt-3">Register</p>
    <hr class="hr-dark">
    <form action="" method="post" class="col-lg-6">
    <input type="hidden" name="id" value="">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="firstName">First Name</label>
                    <input type="text" name="firstName" id="firstName" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="lastName">Last Name</label>
                    <input type="text" name="lastName" id="lastName" class="form-control">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>
        <div class="form-group">
            <label for="password2">Confirm Password</label>
            <input type="password" name="password2" id="password2" class="form-control">
        </div>
        <div class="from-group">
            <button type="submit" id="submit-btn" class="btn btn-primary">Register</button>
            <button type="reset" id="reset-btn" class="btn btn-secondary ml-2">Reset</button>
        </div>
    </form>
</div>
</section>