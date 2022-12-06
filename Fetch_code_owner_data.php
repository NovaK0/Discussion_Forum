<?php

// SETUP SQL CONNECTION 

include "Sql_connection/sql_connection.php" ; 

// GET USERNAME

session_start() ; 

$username = $_POST["owner_username"] ; 

$Likecount_value = $_POST["count"] ; 

// GET USER DATA 

$Fetch_code_owner_data = " SELECT `Instagram` , `Twitter`, `Weburl` FROM `userdata` WHERE `Username` = '$username'" ;

$Fetch_code_owner_data_result = mysqli_query($Database_connection, $Fetch_code_owner_data) ; 

$Fetch_code_owner_data_result = mysqli_fetch_assoc($Fetch_code_owner_data_result) ; 

$_SESSION["Owner-username"] = $username ; 

$_SESSION["Owner-instagram"] = $Fetch_code_owner_data_result["Instagram"] ; 

$_SESSION["Owner-twitter"] = $Fetch_code_owner_data_result["Twitter"] ; 

$_SESSION["Owner-weburl"] = $Fetch_code_owner_data_result["Weburl"] ; 

$_SESSION["Owner-codelike"] = $Likecount_value ; 

echo "Set" ; 
?> 