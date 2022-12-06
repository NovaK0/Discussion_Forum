<?php

// Setup sql connection 

include "Sql_connection/sql_connection.php" ; 

// --- Get last email address value 

session_start() ; 

$Last_email_address = $_SESSION["Emailaddress"] ; 

// --- Get new email address 

$New_email_address = $_POST["Update_email"] ; 

// --- Check this email address in database 

$Check_email_query = "SELECT `Emailaddress` FROM `userdata` WHERE `Emailaddress` = '$New_email_address' " ;

$Check_email_query_result = mysqli_query($Database_connection , $Check_email_query) ; 

$Row_count = mysqli_num_rows($Check_email_query_result) ; 
if($Row_count > 0 ){
    echo "Find" ; 
}

else{

    // --- Create verification code
 
    $Code = "1234567890";
    $Code = str_shuffle($Code);
    $Verify_code = substr($Code,0,5);

    // --- Send verification code on email 

    $apikey = "fO5jkC4-kOTVtyJJQ__O7MhXeIgqCyxjKJgH7Rq401M";
    $event  = "otp_verification";
    $value1 = $New_email_address;
    $value2 = $Verify_code;
    $value3 = "";

    $ch = curl_init();

    $postdata = json_encode([
                    "value1" => $value1,
                    "value2" => $value2,
                    "value3" => $value3,
                    ]);

    $header = array();
    $header[] = "Content-Type: application/json";

    curl_setopt($ch,CURLOPT_URL, "https://maker.ifttt.com/trigger/$event/with/key/$apikey");
    curl_setopt($ch,CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch,CURLOPT_POST, 1);
    curl_setopt($ch,CURLOPT_POSTFIELDS, $postdata);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);

    $result = curl_exec($ch);

    // --- set verification code value in session 

    $_SESSION["Update-email-code"] = $Verify_code ; 

    $_SESSION["Update-email"] = $New_email_address ; 

    $_SESSION["Update-last-email"] = $Last_email_address ; 
    
    $_SESSION["Emailaddress"] = $New_email_address ; 
    
    echo "Send" ; 
}

?>