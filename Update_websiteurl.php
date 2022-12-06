<?php

// Setup sql connection // 

include "Sql_connection/sql_connection.php" ; 

// Get username // 

session_start() ; 

$Username = $_SESSION["username"] ; 

// --- Get website url --- 

$Website_url = $_POST["url"] ; 

// --- Update website query --- 

$Update_website_url_query = "UPDATE `userdata` SET `Weburl` = '$Website_url' WHERE `Username` = '$Username'  " ; 

$Update_website_url_query_result = mysqli_query($Database_connection , $Update_website_url_query) ; 

$_SESSION["Websiteurl"] = $Website_url ; 

echo "Update" ; 
?>