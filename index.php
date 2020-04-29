
<?php include('components/header.comp.php'); ?>
<?php include('components/nav.comp.php'); ?>
    <div class="container">
        <?php if(isset($_GET['logout']) == 'success') : ?>
            <p class="bg-success">You are now logged out.</p>
        <?php endif; ?> 
        <?php
            if (isset($_SESSION['user_id']))
            {
                echo "Logged in!";
            }
            else
            {
                echo "Logged out!";
            }
        ?>
    </div>
<?php include('components/footer.comp.php'); ?>


