<?php
/**
 * This PHP Script is connecting to the database.
 * 
 * This is using the MySQLi PHP extenstion.
 */

//Database credentials
$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "login";

$conn = mysqli_connect($servername, $dbUsername, $dbPassword, $dbName);

if (!$conn)
{
    die("Connection failed: " .mysqli_connect_error());
}