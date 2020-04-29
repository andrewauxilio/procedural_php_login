<?php

//Start session to access session variables.
session_start();
//Removes session variables.
session_unset();
//Removes all data associated with the user.
session_destroy();
//Redirect to index page with success message.
header("Location: ../index.php?logout=success");
exit();
