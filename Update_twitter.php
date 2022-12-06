<?php

// Setup sql connection // 

include "Sql_connection/sql_connection.php" ; 

//  Get username //
 
session_start() ; 

$Username = $_SESSION["username"] ; 

// Get twitter username // 

$Twitter_username = $_POST["twitter_username"] ; 

// Update twitter username query 

$Update_twitter_usrename_query = "UPDATE `userdata` SET `Twitter` = '$Twitter_username' WHERE `Username` = '$Username' " ; 

$Update_twitter_username_query_result = mysqli_query($Database_connection, $Update_twitter_usrename_query) ; 

$_SESSION["Twitter"] = $Twitter_username ; 
echo "Update" ; 

?>