<?php

// Setup sql connection //

include "Sql_connection/sql_connection.php" ; 

// Get username

session_start() ; 

$Username = $_SESSION["username"] ; 

// Get password

$Password = $_POST["password_value"] ; 

// Create Encrypt password

$Encrypt_password = password_hash($Password , PASSWORD_BCRYPT) ; 

// Password update query 

$Password_update_query = "UPDATE `userdata` SET `Password` = '$Encrypt_password' WHERE `Username` = '$Username' " ; 

$Password_update_query_result = mysqli_query($Database_connection, $Password_update_query) ; 

echo "Update" ; 

?>