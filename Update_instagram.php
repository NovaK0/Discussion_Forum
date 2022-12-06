<?php

// Setup sql connection // 

include "Sql_connection/sql_connection.php" ; 

// Get instagram username value // 

session_start() ; 

$Instragram_username_value = $_POST["insta_username"] ; 

// Get main username // 

$Username = $_SESSION["username"] ; 

// --- Update username query --- // 

$Update_instagram_username_query = "UPDATE `userdata` SET `Instagram` = '$Instragram_username_value' WHERE `Username` = '$Username' " ; 

$Update_instagram_username_query_result = mysqli_query($Database_connection, $Update_instagram_username_query) ; 

$_SESSION["Instagram"] = $Instragram_username_value ; 

echo "Update" ; 

?>