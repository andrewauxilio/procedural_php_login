    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <?php if(isset($_SESSION['user_id'])) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php">Dashboard</a>
                </li>
                <?php endif; ?>
            </ul>
            <?php if(!isset($_SESSION['user_id'])) : ?>
            <form action="functions/login.func.php" method="POST" class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" name="usermail" type="text" placeholder="username or email">
                <input class="form-control mr-sm-2" name="password" type="password" placeholder="password">
                <button class="btn btn-light my-2 my-sm-0" name="login-submit" type="submit">Login</button>
            </form>
            <?php endif; ?>

            <?php if(!isset($_SESSION['user_id'])) : ?>
            <button class="btn btn-light my-2 my-sm-0 ml-2" href="register.php">Register</button>
            <?php else: ?>
            <form action="functions/logout.func.php" method="POST">
                <button class="btn btn-light my-2 my-sm-0 ml-2" name="logout-submit" type="submit">Logout</button>
            </form>
            <?php endif; ?>
        </div>
    </nav>