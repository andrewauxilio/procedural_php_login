
<?php include('components/header.comp.php'); ?>
<?php include('components/nav.comp.php'); ?>
    <div class="container">
        <?php if(isset($_GET['login']) == 'success') : ?>
            <p class="bg-success">You are now logged in.</p>
        <?php endif; ?> 
        <?php
        var_dump($_SESSION);
        echo $_SESSION['user_id'];
        echo $_SESSION['user_name'];
        echo $_SESSION['user_email'];
        ?>
    </div>
<?php include('components/footer.comp.php'); ?>


