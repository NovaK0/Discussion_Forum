<?php 

// File which do like of any code // 


// SETUP SQL CONNECTION 

include "Sql_connection/sql_connection.php" ; 

// GET USERNAME 

session_start() ; 

$Username = $_SESSION["username"] ; 

// GET POST VALUE 

// 1. Codeid 

$Codeid = $_POST["codeid"] ; 

// 2. Like value 
// --> 1. For already like this code 
// --> 0. For not like this code 

$Like_value = $_POST["likevalue"] ; 


if ($Like_value == "0"){

    // GET LIKECOUNT VALUE IN `codedata` table 

    $Codedata_table = "SELECT `Codelike` FROM `codedata` WHERE `Codeid` = '$Codeid' " ; 

    $Codedata_table_result = mysqli_query($Database_connection , $Codedata_table) ; 

    $Codedata_table_like_count = mysqli_fetch_assoc($Codedata_table_result) ; 

    // Code Likecount value 

    $Codedata_table_like_count = $Codedata_table_like_count["Codelike"] ; 
    
    $Codedata_table_like_count = intval($Codedata_table_like_count) ; 


    // UPDATE LIKECOUNT VALUE IN `codedata` table 

    $Codedata_table_like_count = $Codedata_table_like_count + 1 ;

    $Codedata_table_like_count = strval($Codedata_table_like_count) ; 

    $Codedata_table_update_like_count = "UPDATE `codedata` SET `Codelike` = '$Codedata_table_like_count' WHERE `Codeid` = '$Codeid' " ; 

    $Codedata_table_update_like_count_result = mysqli_query($Database_connection , $Codedata_table_update_like_count) ; 


    // CREATE THIS LIKEENTRY IN `codelike` table  

    $date = date_default_timezone_set('Asia/Kolkata');
    $timestamp = date("Y-m-d H:i:s");

    $Codelike_entry_table_value = $Username."**".$timestamp ; 

    $Codelike_table_new_entry_query = "INSERT INTO `codelike` ( `Username`, `Codeid` ) VALUES ('$Codelike_entry_table_value', '$Codeid') " ; 

    $Codelike_table_query_result = mysqli_query($Database_connection , $Codelike_table_new_entry_query) ; 
        

    // GET LIKECOUNT VALUE FROM 'userdata' table for create unique id for `userlikedislike` table 
    
    $Get_userdata_table_like_count = "SELECT `Likecount` FROM `userdata` WHERE `Username` = '$Username' " ; 

    $Get_userdata_table_like_count = mysqli_query($Database_connection , $Get_userdata_table_like_count) ; 

    $User_like_count = mysqli_fetch_assoc($Get_userdata_table_like_count) ; 

    $User_like_count = $User_like_count["Likecount"] ; 


    // GET COUNT VALUE FROM `userlikedislike` table  

    $User_like_dislike_table_unique_id = $Username.'-'.$User_like_count ; 

    $Get_count_value_in_userlikedislike_table = "SELECT `Count` FROM `userlikedislike` WHERE `Username` = '$User_like_dislike_table_unique_id' " ; 

    $Get_count_value_in_userlikedislike_table_result = mysqli_query($Database_connection , $Get_count_value_in_userlikedislike_table) ; 

    $Count_value = mysqli_fetch_assoc($Get_count_value_in_userlikedislike_table_result) ; 

    $Count_value = $Count_value["Count"] ; 


    //  CHECK COUNT VALUE


    if($Count_value == "52"){

        // UPDATE LIKECOUNT VALUE IN `userdata` table    

        $User_like_count = strval(intval($User_like_count)+1) ; 

        $Update_user_like_count_query = "UPDATE `userdata` SET `Likecount` = '$User_like_count' WHERE `Username`= '$Username' " ; 

        $Update_user_like_count_query_result = mysqli_query($Database_connection , $Update_user_like_count_query) ; 


        // CREATE NEW LIKE ENTET IN `userlikedislike` table  

        $User_like_dislike_table_id = $Username."-".$User_like_count ; 

        $Like_entry_value = "0**".$Codeid ; 

        $Update_like_dislike_table_new_entry = "INSERT INTO `userlikedislike` (`Username`, `Count`, `U1`, `U2`, `U3`, `U4`, `U5`, `U6`, `U7`, `U8`, `U9`, `U10`, `U11`, `U12`, `U13`, `U14`, `U15`, `U16`, `U17`, `U18`, `U19`, `U20`, `U21`, `U22`, `U23`, `U24`, `U25`, `U26`, `U27`, `U28`, `U29`, `U30`, `U31`, `U32`, `U33`, `U34`, `U35`, `U36`, `U37`, `U38`, `U39`, `U40`, `U41`, `U42`, `U43`, `U44`, `U45`, `U46`, `U47`, `U48`, `U49`, `U50`, `U51`, `U52`) 
        VALUES ('$User_like_dislike_table_id', '1', '$Like_entry_value', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '') " ; 

        $Update_like_dislike_table_new_entry_result = mysqli_query($Database_connection , $Update_like_dislike_table_new_entry) ; 
        
        array_push($_SESSION["Like-codeid-data"] , $Codeid ) ; 

        echo "Activelike" ; 

    }

    else{

        // CREATE COLUMN NAME FOR `userlikedislike` table 

        $Count_value = strval(intval($Count_value)+1) ; 

        $Username_column_name = "U".$Count_value ; 
        
        // CREATE LIKE ENTRY value 

        $Like_entry_value = "0**".$Codeid ; 

        $User_like_dislike_table_id = $Username."-".$User_like_count ; 

        $Add_like_codeid_in_userlikedislike_table = "UPDATE `userlikedislike` SET `$Username_column_name` = '$Like_entry_value' , `Count` = '$Count_value' 
        WHERE `Username` = '$User_like_dislike_table_id' " ; 

        $Add_like_dislike_table_result = mysqli_query($Database_connection , $Add_like_codeid_in_userlikedislike_table) ; 

        array_push($_SESSION["Like-codeid-data"] , $Codeid ) ; 

        echo "Activelike" ; 
    }
}

else{

    // GET Codelike value form  `codedata` table 

    $Codedata_table_likecount_query = "SELECT `Codelike` FROM `codedata` WHERE `Codeid` = '$Codeid' " ;
    
    $Codedata_table_likecount_query_result = mysqli_query($Database_connection , $Codedata_table_likecount_query) ; 

    $Codedata_table_likecount_query_result = mysqli_fetch_assoc($Codedata_table_likecount_query_result) ; 

    $Codedata_like_count = $Codedata_table_likecount_query_result["Codelike"] ; 

    $Codedata_like_count = strval(intval($Codedata_like_count) - 1) ;

    // DESCRIMENT codelike value in `codedata` table 

    $Codedata_table_likecount_update_query = "UPDATE `codedata` SET `Codelike` = '$Codedata_like_count' WHERE `Codeid` = '$Codeid' " ; 

    $Codedata_table_likecount_update_query_result = mysqli_query($Database_connection , $Codedata_table_likecount_update_query) ; 

    // DO Codedislike entry in `codelike` table 

    $Code_dislike_value = "D**".$Codeid ; 

    $Codedislike_table_entry = "INSERT INTO `codelike` (`Username`, `Codeid`) VALUES ('$Username', '$Code_dislike_value') " ; 

    $Codedislie_table_query_result = mysqli_query($Database_connection , $Codedislike_table_entry) ; 
        
    // GET LIKECOUNT VALUE FORM  `userdata` table 

    $Get_userdata_table_like_count = "SELECT `Likecount` FROM `userdata` WHERE `Username` = '$Username' " ; 

    $Get_userdata_table_like_count = mysqli_query($Database_connection , $Get_userdata_table_like_count) ; 

    $User_like_count = mysqli_fetch_assoc($Get_userdata_table_like_count) ; 

    $User_like_count = $User_like_count["Likecount"] ; 

    for($i=0; $i<intval($User_like_count)+1 ; $i++){
        
        // Create unique id for `userlikedislike` table 

        $Unique_id_for_user_like_dislike_table = $Username.'-'.$i ; 

        // Fetch data from `userlikedislike` table using unique id 

        $Fetch_data = "SELECT * FROM `userlikedislike` WHERE `Username` = '$Unique_id_for_user_like_dislike_table' " ; 

        $Fetch_data = mysqli_query($Database_connection , $Fetch_data) ; 
       
        $Fetch_data = mysqli_fetch_assoc($Fetch_data) ; 

        // Get COUNT VALUE

        $Fetch_data_count_value = $Fetch_data["Count"] ; 

        for($j=1 ; $j<intval($Fetch_data_count_value)+1 ; $j++){

            // CREATE COLUMN NAME

            $U_name_column = "U".$j ; 

            // FETCH DATA USING COLUMN NAME 

            $U_data = $Fetch_data[$U_name_column] ; 

            // GET DATA 

            // 1. Get code id 

            $Fecth_data_code_id = explode("**", $U_data)[1] ; 

            // 2. Get First attributes

            $Fetch_data_first_attribute = explode("**", $U_data)[0] ; 

            if($Fecth_data_code_id == $Codeid){

                if($Fetch_data_first_attribute == "0"){

                    $Fetch_data_update_value = "D**".$Codeid ; 

                    $Fetch_data_update_like_value_query = " UPDATE `userlikedislike` SET `$U_name_column` = '$Fetch_data_update_value' WHERE `Username`= '$Unique_id_for_user_like_dislike_table' " ; 

                    $Run_query = mysqli_query($Database_connection , $Fetch_data_update_like_value_query) ; 

                    break ; 
                }
            }

            else{

            }

            
        }

    }

    unset($_SESSION["Like-codeid-data"][$Codeid]);
    
    echo "Dislike" ; 
}

?>