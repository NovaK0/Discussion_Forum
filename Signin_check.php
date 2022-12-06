<?php

// FILE FOR SIGNIN PROCESS 

// SQTUP SQL CONNECTION 

include "Sql_connection/sql_connection.php" ; 

// GET USSERNAME AND PASSWORD

$Username = $_POST['Username_value'] ; 

$Password = $_POST["Password_value"] ; 

// 1. First check this username available in database or not 

$Fetch_username_password_query = "SELECT `Username` , `Password` , `Id` FROM `userdata` WHERE `Username` = '$Username' " ; 

$Fetch_username_password_query_result = mysqli_query($Database_connection , $Fetch_username_password_query) ; 

$Row_value = mysqli_num_rows($Fetch_username_password_query_result) ; 

$Fetch_data = mysqli_fetch_assoc($Fetch_username_password_query_result) ;

if($Row_value == 0 ){

    echo "Notfind" ; 
    
}

else{

    // Check password 

    if(password_verify($Password , $Fetch_data["Password"])){

        setcookie("id", "", time()-3600 , "/") ; 
        setcookie("id", $Fetch_username_password_query_result["Id"], time() + (86400*30), "/") ; 
        
        header("location: ./codestyle.php") ; 
    }

    else{

        echo "Invaildpassword" ; 
    }
}



?>