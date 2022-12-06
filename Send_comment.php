<?php

// SETUP SQL CONNECTION 

include "Sql_connection/sql_connection.php" ; 

// GET USERNAME

session_start() ; 

$Username = "dfdfdfdf" ; 


// GET POST VALUE 

// 1. Get code unique id 

$Code_unique_id = $_POST["comment_code_id"]; 

// 2. Get comment value 

$Comment_value = $_POST["comment_message"] ; 


// Fetch Commentcolumnvalue in `codedata` table 

$Get_comment_value_query = "SELECT `Commentcolumnvalue` FROM `codedata` WHERE `Codeid` = '$Code_unique_id' " ;

$Get_comment_value_query_result = mysqli_query($Database_connection , $Get_comment_value_query) ; 

$Get_comment_value_query_result = mysqli_fetch_assoc($Get_comment_value_query_result) ; 

// Commentcolumn value

$Commentcolumnvalue = $Get_comment_value_query_result["Commentcolumnvalue"] ; 


// Fetch Commentcount value in `codecommentdata` table 

$Comment_data_code_id = $Code_unique_id.'-'.$Commentcolumnvalue ; 

$Comment_send_value = "SELECT `Commentcount` FROM `codecommentdata` WHERE `Codeid` = '$Comment_data_code_id' " ; 

$Comment_send_value_result = mysqli_query($Database_connection , $Comment_send_value) ; 

$Comment_send_value_result = mysqli_fetch_assoc($Comment_send_value_result) ; 

// Commentcount value 

$Comment_count_value = $Comment_send_value_result['Commentcount'] ; 


// Check Commentcount value 

// 1. If Commentcount value is 60 than create new entry in `codecommentdata` table and 
//    update Commentcolumnvalue in `codedata` table

if($Comment_count_value == "60"){

    // Update Commentcolumnvalue for `codedata` table 

    $Commentcolumnvalue = strval(intval($Commentcolumnvalue)+1) ; 

    // Update Commentcolumnvalue in `codedata` table 

    $Update_comment_column_value_in_codedata_table = "UPDATE `codedata` SET `Commentcolumnvalue` = '$Commentcolumnvalue' WHERE `Codeid` = '$Code_unique_id'  " ; 

    $Update_comment_column_value_in_codedata_table_result = mysqli_query($Database_connection , $Update_comment_column_value_in_codedata_table) ; 
   
    // Create new code unique id for `codecommentdata` table 
    
    $New_comment_table_id = $Code_unique_id.'-'.$Commentcolumnvalue  ; 

    // Get date and time 

    $date = date_default_timezone_set('Asia/Kolkata');
    $timestamp = date("Y-m-d H:i:s");

    // `codecommentdata` table entry value 

    $Codecommentdata_table_entry_value = $Username."**".$timestamp ; 

    // Create new entry in `codecommentdata` table  

    $Add_new_entry_comment_data_table = "INSERT INTO `codecommentdata` (`Codeid`, `Commentcount`, `U1`, `U2`, `U3`, `U4`, `U5`, `U6`, `U7`, `U8`, `U9`, `U10`, `C1`, `C2`, `C3`, `C4`, `C5`, `C6`, `C7`, `C8`, `C9`, `C10`, `U11`, `U12`, `U13`, `U14`, `U15`, `U16`, `U17`, `U18`, `U19`, `U20`, `C11`, `C12`, `C13`, `C14`, `C15`, `C16`, `C17`, `C18`, `C19`, `C20`, `U21`, `U22`, `U23`, `U24`, `U25`, `U26`, `U27`, `U28`, `U29`, `U30`, `C21`, `C22`, `C23`, `C24`, `C25`, `C26`, `C27`, `C28`, `C29`, `C30`, `U31`, `U32`, `U33`, `U34`, `U35`, `U36`, `U37`, `U38`, `U39`, `U40`, `C31`, `C32`, `C33`, `C34`, `C35`, `C36`, `C37`, `C38`, `C39`, `C40`, `U41`, `U42`, `U43`, `U444`, `U45`, `U46`, `U47`, `U48`, `U49`, `U50`, `C41`, `C42`, `C43`, `C44`, `C45`, `C46`, `C47`, `C48`, `C49`, `C50`, `U51`, `U52`, `U53`, `U54`, `U55`, `U56`, `U57`, `U58`, `U59`, `U60`, `C51`, `C52`, `C53`, `C54`, `C55`, `C56`, `C57`, `C58`, `C59`, `C60`) 
    VALUES ('$New_comment_table_id', '1', '$Codecommentdata_table_entry_value', '', '', '', '', '', '', '', '', '', '$Comment_value', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''); " ; 
    
    $Add_new_entry_comment_table_result = mysqli_query($Database_connection , $Add_new_entry_comment_data_table) ; 

    // Also set this comment data in `codedata` table 

    $Codedata_table_update_comment_query = "UPDATE `codedata` SET `Commentusername` = '$Username' , `Commentvalue`= '$Comment_value' WHERE `Codeid` = '$Code_unique_id' " ; 
    
    $Codedata_table_update_comment_query_result = mysqli_query($Database_connection , $Codedata_table_update_comment_query) ; 

    echo "sendcomment" ; 
}

else{

    // Update Commentcount value 

    $Comment_count_value = strval(intval($Comment_count_value)+1) ; 

    // Create Username and Comment column name 
    
    $Username_column_name = "U".$Comment_count_value ; 
    $Comment_column_name = "C".$Comment_count_value ; 

    // Get date and time 

    $date = date_default_timezone_set('Asia/Kolkata');
    $timestamp = date("Y-m-d H:i:s");

    // Create `codecommentdata` table entry value 

    $Codecommentdata_table_entry_value = $Username."**".$timestamp ; 

    // Add commentvalue in table 

    $Update_username_comment_query = "UPDATE `codecommentdata` SET `$Username_column_name` = '$Codecommentdata_table_entry_value' , `$Comment_column_name` = '$Comment_value', 
    `Commentcount` = '$Comment_count_value' WHERE `Codeid` = '$Comment_data_code_id' " ; 

    $Update_username_comment_query_result = mysqli_query($Database_connection , $Update_username_comment_query) ; 

    $Codedata_table_update_comment_query = "UPDATE `codedata` SET `Commentusername` = '$Username' , `Commentvalue`= '$Comment_value' WHERE `Codeid` = '$Code_unique_id' " ; 
    
    $Codedata_table_update_comment_query_result = mysqli_query($Database_connection , $Codedata_table_update_comment_query) ; 
    
    echo "sendcomment" ; 
}

?>