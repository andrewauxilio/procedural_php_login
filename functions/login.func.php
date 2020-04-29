<?php


//var_dump($_POST['usermail']);
//die();
if (isset($_POST['login-submit']))
{
    //
    include('database.func.php');

    $usermail = $_POST['usermail'];
    $password = $_POST['password'];

    //If email or password field is empty, throw error
    if (empty($usermail) || empty($password))
    {
        header("Location: ../index.php?error=emptyfields");
        exit();
    }
    //If email field is empty, throw error
    else if (empty($usermail))
    {
        header("Location: ../index.php?error=emptyemail");
        exit();
    }
    //If password field is empty, throw error
    else if (empty($password))
    {
        header("Location: ../index.php?error=emptypassword&email=".$usermail);
        exit();
    }
    /**
     * Start of Login Process
     */

    //If no error is thrown, start preparing to execute SQL query.
    else 
    {
        $sql = "SELECT * FROM users WHERE email=? OR username=?;";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql))
        {
            header("Location: ../index.php?error=sqlerror");
            exit(); 
        } 
        else
        {
            mysqli_stmt_bind_param($stmt, "ss", $usermail, $usermail);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result))
            {
                $pwdCheck = password_verify($password, $row['password']); 

                if ($pwdCheck == false)
                {
                    header("Location: ../index.php?error=wrongpassword");
                    exit(); 
                }
                else if ($pwdCheck == true)
                {
                    session_start();
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['user_name'] = $row['username'];
                    $_SESSION['user_email'] = $row['email'];

                    header("Location: ../dashboard.php?login=success");
                    exit(); 
                }
                else
                {
                    header("Location: ../index.php?error=wrongpassword");
                    exit(); 
                }
            }
            else
            {
                header("Location: ../index.php?error=nouserexists");
                exit(); 
            }
        }
        
    }

}
else 
{
    header("Location: ../index.php");
    exit();
}