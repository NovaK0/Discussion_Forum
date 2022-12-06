<?php

// --- Setup sql connection --- // 

include "Sql_connection/sql_connection.php" ; 

// ---- Set all session variable ---- // 

session_start() ; 

$Username = $_SESSION["Username"] ; 
$Emailaddress = $_SESSION["Emailaddress"]; 
$Password = $_SESSION["Password"]; 
$Loginkey = $_SESSION["Loginkey"] ; 
$Verification_code = $_SESSION["Verificationcode"] ; 

// --- Get post varification code value --- // 

$Get_verification_code = $_POST["verifycode"]; 

// --- Create port number --- // 

$Port_number = "1234567890";
$Port_number = str_shuffle($Port_number);
$Verify_code = substr($Port_number,0,5);

if($Get_verification_code != $Verification_code){
    echo "Not match" ; 
}

else{

    $Encrypt_password = password_hash($Password , PASSWORD_BCRYPT);
    
    $New_user_entry_query = "INSERT INTO `userdata` (`Username`, `Emailaddress`, `Password`, `Id`, `codecount`, `Portnumber`, `Instagram`, `Twitter`, `Weburl`, `Likecount`) 
    VALUES ('$Username' , '$Emailaddress' ,  '$Encrypt_password' ,  '$Loginkey', '0', '$Verify_code' , 'Notset', 'Notset', 'Notset', '0')" ; 
   
    $Add_new_entry = mysqli_query($Database_connection , $New_user_entry_query) ; 
    
    $Like_table_uniuqe_id = $Username."-0" ; 

    $Like_query = "INSERT INTO `userlikedislike` (`Username`, `Count`, `U1`, `U2`, `U3`, `U4`, `U5`, `U6`, `U7`, `U8`, `U9`, `U10`, `U11`, `U12`, `U13`, `U14`, `U15`, `U16`, `U17`, `U18`, `U19`, `U20`, `U21`, `U22`, `U23`, `U24`, `U25`, `U26`, `U27`, `U28`, `U29`, `U30`, `U31`, `U32`, `U33`, `U34`, `U35`, `U36`, `U37`, `U38`, `U39`, `U40`, `U41`, `U42`, `U43`, `U44`, `U45`, `U46`, `U47`, `U48`, `U49`, `U50`, `U51`, `U52`) 
    VALUES ('$Like_table_uniuqe_id', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '') " ; 

    $Like_query_result = mysqli_query($Database_connection , $Like_query) ; 

    $Random_codeid_query = "SELECT `Codeid` FROM `codedata`  ORDER BY RAND ( )  LIMIT 2  " ; 
    
    $Random_codeid_query_result = mysqli_query($Database_connection , $Random_codeid_query) ; 

    $Random_codeid_query_result = mysqli_fetch_all($Random_codeid_query_result, MYSQLI_ASSOC) ; 

    $Option_codeid = $Random_codeid_query_result[0]["Codeid"]."**".$Random_codeid_query_result[1]["Codeid"] ; 

    $Update_search_value_result = "INSERT INTO `usersearch` (`Username` , `searchvalue`) VALUES ('$Username' , '$Option_codeid') " ; 

    $Update_search_value_query_result = mysqli_query($Database_connection , $Update_search_value_result) ; 
    
    if(isset($_COOKIE["id"])){
        setcookie("id", "", time()-3600, "/") ; 
    }
    else{}
    
    setcookie("id", $Loginkey , time()+ (86400*30), "/") ; 
    
    echo "Done" ; 
}
?>