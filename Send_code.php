<?php

// File is upload code in database // 

// --- Setup Sql connection --- // 

include "Sql_connection/sql_connection.php" ; 

// --- Get all post variable --- // 

$Code_title = $_POST["Send_code_title"]; 

$Code_language = $_POST["Send_code_language"] ; 

$Code =  $_POST["Send_code"] ; 

$Code_searching_word = $_POST["Send_code_searching_word"] ; 

$Code_problem_value = $_POST["Send_code_problem_value"] ; 

// --- Set Username --- // 

session_start() ; 

$Username = $_SESSION["username"] ; 


// --- Get codecount value in main userdata table --- // 
// --- USERDATA TABLE --- // 


$Userdata_table_code_count_get_query = "SELECT `codecount` FROM `userdata` WHERE `Username` = '$Username' " ; 

$Userdata_table_code_count_get_query_result = mysqli_query($Database_connection , $Userdata_table_code_count_get_query) ; 

$Userdata_code_count_row = mysqli_fetch_array($Userdata_table_code_count_get_query_result, MYSQLI_ASSOC) ; 


// --> Update code count value 

$Code_count_value = $Userdata_code_count_row["codecount"] ; 
$Code_count_value = strval(intval($Code_count_value)+1) ; 


// --> Create code unique id 

$Code_unique_id = $Username.'-'.$Code_count_value ; 


// --> Add new code entry query 

$Add_new_code_data_entry_query = " INSERT INTO `codedata` (`Username`, `Codeid`, `Codetitle`, `Codelanguage`, `Codelike`, `Problemvalue`, `Commentcolumnvalue`, `Code`,`Commentusername`, `Commentvalue`) 
VALUES ('$Username', '$Code_unique_id', '$Code_title', '$Code_language', '0', '$Code_problem_value', '0', '$Code','NULL', 'NULL') " ; 

$Add_new_code_entry_result = mysqli_query($Database_connection, $Add_new_code_data_entry_query) ; 


// --> Add new entry in Codecommentdata table 

$Comment_table_code_id = $Code_unique_id.'-0' ; 

$Add_new_entry_comment_data_table = "INSERT INTO `codecommentdata` (`Codeid`, `Commentcount`, `U1`, `U2`, `U3`, `U4`, `U5`, `U6`, `U7`, `U8`, `U9`, `U10`, `C1`, `C2`, `C3`, `C4`, `C5`, `C6`, `C7`, `C8`, `C9`, `C10`, `U11`, `U12`, `U13`, `U14`, `U15`, `U16`, `U17`, `U18`, `U19`, `U20`, `C11`, `C12`, `C13`, `C14`, `C15`, `C16`, `C17`, `C18`, `C19`, `C20`, `U21`, `U22`, `U23`, `U24`, `U25`, `U26`, `U27`, `U28`, `U29`, `U30`, `C21`, `C22`, `C23`, `C24`, `C25`, `C26`, `C27`, `C28`, `C29`, `C30`, `U31`, `U32`, `U33`, `U34`, `U35`, `U36`, `U37`, `U38`, `U39`, `U40`, `C31`, `C32`, `C33`, `C34`, `C35`, `C36`, `C37`, `C38`, `C39`, `C40`, `U41`, `U42`, `U43`, `U444`, `U45`, `U46`, `U47`, `U48`, `U49`, `U50`, `C41`, `C42`, `C43`, `C44`, `C45`, `C46`, `C47`, `C48`, `C49`, `C50`, `U51`, `U52`, `U53`, `U54`, `U55`, `U56`, `U57`, `U58`, `U59`, `U60`, `C51`, `C52`, `C53`, `C54`, `C55`, `C56`, `C57`, `C58`, `C59`, `C60`) 
VALUES ('$Comment_table_code_id', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''); " ; 

$Add_new_entry_comment_table_result = mysqli_query($Database_connection , $Add_new_entry_comment_data_table) ; 

// --> Update code count value in userdata table  

$Update_code_count_value_query = "UPDATE `userdata` SET `codecount` = '$Code_count_value' WHERE `Username` = '$Username' " ; 

$Update_code_count_query_result = mysqli_query($Database_connection , $Update_code_count_value_query) ;


// --> Add searching words in codesearchingword table 

$All_searching_word_array = explode(",", $Code_searching_word) ; 

$All_searching_word_array_length = count($All_searching_word_array) ; 


for($i=0 ; $i<$All_searching_word_array_length ; $i++){
    
    $Search_word = trim($All_searching_word_array[$i]) ; 

    // --- Add this word codesearching word table 

    $Add_search_word_in_table_query = "INSERT INTO `codesearchingword` (`Codeid`, `Searchword`) 
    VALUES ('$Code_unique_id', '$Search_word')"; 
    
    $Add_search_word_in_table_result = mysqli_query($Database_connection , $Add_search_word_in_table_query) ; 

}


echo "Done" ; 


?>