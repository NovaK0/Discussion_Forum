<?php

// Setup sql connection 

include "Sql_connection/sql_connection.php" ; 

// --- Get verification code --- 

session_start() ; 

$Verification_code = $_SESSION["Update-email-code"] ; 

$Update_email = $_SESSION["Update-email"] ; 

$Last_email = $_SESSION["Update-last-email"] ; 

// --- Get post verification code value --- 

$Post_verification_code_value = $_POST["Email_verification_code"] ; 

if($Verification_code != $Post_verification_code_value){

    echo "Invaild" ; 
             
}

else{

    // --- Check this email address in database --- 

    $Check_email_query = "SELECT `Emailaddress` FROM `userdata` WHERE `Emailaddress` = '$Update_email' " ;

    $Check_email_query_result = mysqli_query($Database_connection , $Check_email_query) ; 

    $Row_count = mysqli_num_rows($Check_email_query_result) ; 

    if($Row_count > 0 ){
        echo "Find" ; 
    }

    else{
    
        $Update_email_query = "UPDATE `userdata` SET `Emailaddress` = '$Update_email' WHERE `Emailaddress` = '$Last_email'  " ; 

        $Update_email_query_result = mysqli_query($Database_connection , $Update_email_query) ; 

        echo "Updateemail" ; 
    }

}
?>