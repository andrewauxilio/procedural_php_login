<?php

/**
 * ----------------------------------------------------------------------
 * This PHP script is for registering a new user to the database.
 * 
 * Error handling:
 * 1) Username, email, password input check if empty
 * 2) Username character check (pregmatch) and email validation check
 * 3) Username character check (pregmatch)
 * 4) Email validation check.
 * 5) Password and re-type password check.
 * 
 * If there are no errors insert user details into the database
 * and redirect to a page.
 * ----------------------------------------------------------------------
 */

//Checks if the user accessed this script through the submit button. 
if (isset($_POST['register-submit']))
{
    //Include the database connector function.
    include('database.func.php');

    //Instantiate variables for the user input data. 
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $pwcheck = $_POST['pwcheck'];

    /**
     * Error Handling Statements
     */

     //If username OR email OR password is empty, throw an error.
    if (empty($username) || empty($email) || empty($password))
    {
        header("Location: ../register.php?error=emptyfields&username=".$username."email=".$email);
        exit();
    }
    //If invalid email AND username characters, throw error.
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username))
    {
        header("Location: ../register.php?error=invalidusernameemail=");
        exit();
    }
    //If invalid username characters, throw error.
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $username))
    {
        header("Location: ../register.php?error=invalidusername&email=".$email);
        exit();
    }
    //If invalid email, throw error.
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        header("Location: ../register.php?error=invalidemail&username=".$username);
        exit();
    }
    //If password and re-type password don't match, throw error.
    else if ($password !== $pwcheck)
    {
        header("Location: ../register.php?error=invalidpassword&username=".$username."email=".$email);
        exit();
    }
    /**
     * Inserting User Data
     */

     //If no error is thrown, start preparing to execute SQL query.
    else
    {
        $sql = "SELECT username FROM users WHERE username=? OR email=?";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql))
        {
            header("Location: ../register.php?error=sqlerror&");
            exit(); 
        }
        else
        {
            mysqli_stmt_bind_param($stmt, "ss", $username, $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);

            if ($resultCheck > 0)
            {
                header("Location: ../register.php?error=usernameemailtaken&username=".$username."email=".$email);
                exit();
            }
            else
            {
                $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);

                if (!mysqli_stmt_prepare($stmt, $sql))
                {
                    header("Location: ../register.php?error=sqlerror");
                    exit(); 
                }
                else
                {
                    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPwd);
                    mysqli_stmt_execute($stmt);

                    header("Location: ../register.php?register=success");
                    exit(); 
                }
            }
        }
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
else
{
    header("Location: ../register.php");
    exit();
}