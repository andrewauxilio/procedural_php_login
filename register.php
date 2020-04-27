<?php include('components/header.comp.php'); ?>
<?php include('components/nav.comp.php'); ?>
<div class="container">
    <div class="card mx-auto mt-3 col-6">
        <div class="card-body">
            <form action="functions/register.func.php" method="POST">
                <div class="form-group">
                    <label for="exampleInputEmail1">Username</label>
                    <input type="text" name="username" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Re-type Password</label>
                    <input type="password" name="pwcheck" class="form-control" id="exampleInputPassword1">
                </div>
                <button type="submit" name="register-submit" class="btn btn-primary">Register</button>
            </form>
        </div>
    </div>
</div>
<?php include('components/footer.comp.php'); ?>