<?php

// Steup SQL connection // 

include "Sql_connection/sql_connection.php" ; 

// Get all post value 

$Username = $_POST["database_username"] ; 

$Emailaddress = $_POST["database_emailaddress"] ; 

$Password = $_POST["database_password"] ; 


// --- Variable for checking process --- // 

$Checking_process_variable = 0 ; 

// --- Check username in database --- // 

$Username_check_query = "SELECT Username FROM userdata WHERE Username =  '$Username' " ; 

$Username_check_query_data = mysqli_query($Database_connection , $Username_check_query) ; 

if(mysqli_num_rows($Username_check_query_data) > 0 ){

    $Checking_process_variable = 1 ; 
}

else{

    $Checking_process_variable = 0 ; 
}

// --- Check email address in database --- // 

$Emailaddress_check_query = "SELECT Emailaddress FROM userdata WHERE Emailaddress = '$Emailaddress' " ; 

$Emailaddress_check_query_database = mysqli_query($Database_connection , $Emailaddress_check_query) ; 

// ---- Check Email address database records --- // 

if(mysqli_num_rows($Emailaddress_check_query_database) > 0 ){

    if($Checking_process_variable == 1){
        $Checking_process_variable = 3 ; 
    }
    else{
        $Checking_process_variable = 2 ; 
    }

}

else{
    if($Checking_process_variable == 1){
    }
    else{
        $Checking_process_variable = 0 ; 
    }
}

if($Checking_process_variable == 1){
    echo "Findusername" ; 
}

elseif ($Checking_process_variable == 2){
    echo "Findemail" ; 
}

elseif ($Checking_process_variable == 3){
    echo "username-email" ; 
}

else{

// ---- Create verification code ---- // 

$Code = "1234567890";
$Code = str_shuffle($Code);
$Verify_code = substr($Code,0,5);

// ---- Create login id ----- // 

$Login_address_key = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%^&*()" ; 
$Login_address_key = str_shuffle($Login_address_key) ; 
$Login_key = substr($Login_address_key, 0 , 15) ; 

// ---- Send email ---- // 

$apikey = "fO5jkC4-kOTVtyJJQ__O7MhXeIgqCyxjKJgH7Rq401M";
$event  = "otp_verification";
$value1 = $Emailaddress;
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

curl_close($ch);

echo "Send" ; 

// --- Set all value in session variable --- // 

session_start() ; 

$_SESSION["Username"] = $Username ; 
$_SESSION["Emailaddress"] = $Emailaddress ;
$_SESSION["Password"] = $Password ; 
$_SESSION["Loginkey"] = $Login_key ; 
$_SESSION["Verificationcode"] = $Verify_code ; 

}
?>