<?php

// File which fetch all comment data // 

// SETUP SQL CONNECTION 

include "Sql_connection/sql_connection.php" ; 

// GET USERNAME 

session_start() ; 

$Username = $_SESSION["username"]; 

// GET POST VALUE 

$Codeid = $_POST["id"] ; 

$Code_title = $_POST["title"] ; 

// Array which store all comment data 

$Store_comment_data = array() ; 

$All_comment_data_length_value = 0 ; 

// 1. FETCH Commentcolumnvalue from `codedata` table 

$Fetch_commentcolumn_value = "SELECT `Commentcolumnvalue` FROM `codedata` WHERE `Codeid` = '$Codeid' " ; 

$Fetch_commentcolumn_value_result = mysqli_query($Database_connection, $Fetch_commentcolumn_value) ; 

$Fetch_commentcolumn_value_result = mysqli_fetch_assoc($Fetch_commentcolumn_value_result) ; 

// Commentcolumnvalue 

$Commentcolumnvalue = $Fetch_commentcolumn_value_result["Commentcolumnvalue"] ; 

// 2. Fetch Commentdata from `codecommentdata` table using Commentcolumnvalue 

for($i=0 ; $i<intval($Commentcolumnvalue)+1 ; $i++){

    // Create codeid for `codedcommentdata` table 

    $Codecommentdata_table_codeid = $Codeid."-".$i ; 

    // Fetch commentdata  

    $Fetch_commentdata_query = "SELECT * FROM `codecommentdata` WHERE `Codeid` =  '$Codecommentdata_table_codeid' "; 
    
    $Fetch_commentdata_query_result = mysqli_query($Database_connection , $Fetch_commentdata_query) ; 

    $Fetch_commentdata_query_result = mysqli_fetch_assoc($Fetch_commentdata_query_result) ; 

    // Get Count value from `codecommentdata` table fetch data 

    $Count_value = $Fetch_commentdata_query_result["Commentcount"] ; 

    for($j=1 ; $j<intval($Count_value)+1 ; $j++){

        // Create Ussername column name 

        $Username_column_name = "U".$j ; 

        // Create Columnvalue column name 

        $Columnvalue_column_name = "C".$j ; 

        // Fetch data 

        $Username_data = $Fetch_commentdata_query_result[$Username_column_name] ; 
        
        // Get username 

        $Comment_sender_username = explode("**", $Username_data)[0] ; 

        // Get date and time 

        $Date_and_time = explode("**", $Username_data)[1]  ; 

        // Get Commentvalue 

        $Commentvalue = $Fetch_commentdata_query_result[$Columnvalue_column_name] ; 

        // Array for add data in main store array 

        $Data_array = array($Comment_sender_username, $Date_and_time , $Commentvalue) ; 

        $All_comment_data_length_value = $All_comment_data_length_value + 1 ;

        // Add Data array into Main data array 

        array_push($Store_comment_data, $Data_array) ; 
    }

}

// Set comment data array into session variable 

if(isset($_SESSION["All-comment-data"])){
    unset($_SESSION["All-comment-data"]) ; 
}

if(isset($_SESSION["All-comment-data-length"])){
    unset($_SESSION["All-comment-data-length"]) ; 
}

if(isset($_SESSION["All-comment-data-title"])){
    unset($_SESSION["All-comment-data-title"]) ; 
}

$_SESSION["All-comment-data"] = $Store_comment_data ;

$_SESSION["All-comment-data-length"] = $All_comment_data_length_value ; 

$_SESSION["All-comment-data-title"] = $Code_title ; 

echo "Setdata" ; 

?>