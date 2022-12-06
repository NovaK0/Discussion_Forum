<?php

// File which all code data 

// SETUP SQL CONNECTION

include "Sql_connection/sql_connection.php" ; 

// GET USERNAME

session_start() ; 

$Username = $_SESSION["username"] ; 

// CREATE ARRAY WHICH STORE ALL MAIN DATA 

$Store_all_code_list_data_array = array() ; 

$All_data_store_data_length = 0 ; 


// GET ALL CODEID LIST 

$Fetch_codecount_value = "SELECT `codecount` FROM `userdata` WHERE `Username` = '$Username' " ; 

$Fetch_codecount_value_result = mysqli_query($Database_connection , $Fetch_codecount_value) ; 

$Fetch_codecount_value_result = mysqli_fetch_assoc($Fetch_codecount_value_result) ; 

// Get Codecount value 

$Codecount = $Fetch_codecount_value_result["codecount"] ; 

if($Codecount == "Null"){

    echo "notdata" ; 

}

else{

    // Fetch all codedata using using `codedata` table 

    for($i=1 ; $i<intval($Codecount)+1 ; $i++){
    
        // Create unique id for `codedata` table 

        $Codedata_table_unique_id = $Username.'-'.$i ; 
 
        // Get codedata query 
        
        $Get_codedata_query = "SELECT `Codetitle` , `Code` , `Codelike` , `Codelanguage` , `Problemvalue` FROM `codedata` WHERE `Codeid` = '$Codedata_table_unique_id' " ; 

        $Get_codedata_query_result = mysqli_query($Database_connection , $Get_codedata_query) ; 

        $Get_codedata_query_result = mysqli_fetch_assoc($Get_codedata_query_result) ; 

        // --- Read Codetitle 

        $Codetitle = $Get_codedata_query_result["Codetitle"] ; 

        // --- Read Codelanguage

        $Codelanguage = $Get_codedata_query_result["Codelanguage"] ; 

        // --- Read main code 
         
        $Code = $Get_codedata_query_result["Code"] ; 

        // --- Read Codelike value 

        $Codelike = $Get_codedata_query_result["Codelike"] ;

        // --- Read Code problemvalue 

        $Code_problemvalue = $Get_codedata_query_result["Problemvalue"] ; 

        // Add this data into array 

        $Data_array = array($Codedata_table_unique_id , $Codetitle , $Codelanguage , $Code , $Codelike , $Code_problemvalue) ; 
 
        // Add this data into All data store array 

        array_push($Store_all_code_list_data_array , $Data_array) ; 

        $All_data_store_data_length = $All_data_store_data_length +1 ; 

    }


    $_SESSION["All-code-list-data-array"] = $Store_all_code_list_data_array ; 
    
    $_SESSION["All-code-list-data-length"] = $All_data_store_data_length ; 

    echo "Setdata" ; 

}

?>