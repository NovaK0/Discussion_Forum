<?php

// Setup sql connection // 

include "Sql_connection/sql_connection.php" ; 


// --- Get last username ---  

session_start() ; 

$Last_username = "Bhargav162002" ; 


// --- Get New username ---  

$New_username = $_POST["update_username"] ; 


// --- Check this username in database --- 

$Check_username = "SELECT `Username` FROM `userdata` WHERE `Username` = '$New_username' " ; 

$Check_username_result = mysqli_query($Database_connection , $Check_username) ; 

$Row_count = mysqli_num_rows($Check_username_result) ; 

if($Row_count > 0 ){
    echo "Findusername" ; 
}

else{

    $Update_username_query = "UPDATE `userdata` SET `Username` = '$New_username' WHERE `Username` = '$Last_username' " ;

    $Update_username_query_result = mysqli_query($Database_connection , $Update_username_query) ; 

    echo "Updateusername" ; 
}

?>