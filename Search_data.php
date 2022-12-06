<?php

// --- File for search data --- // 


// SETUP SQL CONNECTION

include "Sql_connection/sql_connection.php" ; 


// SETUP USERNAME 

session_start() ; 

$Username = $_SESSION["username"] ; 


// GET SEARCH VALUE

$Search_value = $_POST["searchvalue"] ; 


$Forward_process_variable = 0 ; 


// Array for store codeid after getting result from codesearchingword table  

$Codeid_store_array = array() ; 


// Run query for codesearchingword table 

$Search_result_sql_query = "SELECT `Codeid` FROM `codesearchingword` WHERE `Searchword` LIKE '%$Search_value%' " ; 

$Search_result_sql_query_result = mysqli_query($Database_connection , $Search_result_sql_query) ; 


// Array for store usersearch table codeid for store usersearch result 

$Usersearch_table_array = array() ; 


// ARRAY FOR STORE FINDING SEARCH DATA 


//  1. Store codedata with all details for 15 result 

$Session_variable_store_array = array() ; 

// 2. If result greater than 15 than this array store other searchdata codeid

$Session_store_other_codeid = array() ; 



if(mysqli_num_rows($Search_result_sql_query_result) >0 ){


    // Get search data row number 

    $Search_result_row_number = mysqli_num_rows($Search_result_sql_query_result) ; 
    
    $Search_result_row_number = intval($Search_result_row_number) ; 

    // Fetch all search data 

    $Search_result_sql_query_result = mysqli_fetch_all($Search_result_sql_query_result, MYSQLI_ASSOC);
    

    // HERE, WE FETCH USERSEARCH DATA FROM USERSEARCH TABLE 


    $Usersearch_table_query = "SELECT `searchvalue` FROM `usersearch` WHERE `Username` = '$Username' " ; 

    $Usersearch_table_query_result = mysqli_query($Database_connection , $Usersearch_table_query) ; 

    $User_search_data = mysqli_fetch_assoc($Usersearch_table_query_result) ; 

    $User_search_data = $User_search_data["searchvalue"] ; 


    // Add all usersearch table result into array 

    if($User_search_data == ""){
        
    }

    else{

        // Separate value by "**" 

        $Usersearch_data = explode("**", $User_search_data) ; 

        $Searchdata_length = count($Usersearch_data) ; 

        for($i= 0 ; $i<$Searchdata_length ; $i++){
            
            $Search_value = $Usersearch_data[$i] ; 
            
            array_push($Usersearch_table_array , $Search_value) ; 

        }
   
    }

    // HERE , WE CHECK ALL CODEID FROM 'codesearchingword' TABLE RESULT 

    for($i=0 ; $i<$Search_result_row_number ; $i++){

        //  Read codeid 

        $Codeid_value = $Search_result_sql_query_result[$i]["Codeid"] ;
        

        // First, Check this codeid is there in array or not  

        if(in_array($Codeid_value , $Codeid_store_array)){

        }

        else{
            
            array_push($Codeid_store_array , $Codeid_value) ; 
        }


        // HERE, WE CHECJ THIS 'codesearchingword' table codeid is therr or not in 'Usersearch' table code
        // codeid array 

        if(in_array($Codeid_value , $Usersearch_table_array)){}

        else{

            array_push($Usersearch_table_array,$Codeid_value ) ; 
        }
                
        
    }

    $Forward_process_variable = 1 ; 

}

else{

    
    $Forward_process_variable = 0 ; 
}



if($Forward_process_variable == 1){
    
    // Get Length of codeid store array for 'codesearchingword' table array 
   
    $Codeid_array_length = count($Codeid_store_array) ; 


    if($Codeid_array_length > 15){

        for($i= 0 ; $i<15 ; $i++){

            // Read codeid 

            $Fetch_codeid = $Codeid_store_array[$i] ;       
            
            $Fetch_code_data_query = "SELECT `Codetitle`, `Codelanguage`, `Codelike` , `Problemvalue` , `Code`, `Commentusername` , `Commentvalue` FROM `codedata` WHERE `Codeid` = '$Fetch_codeid' " ; 

            $Fetch_code_data_query_result = mysqli_query($Database_connection , $Fetch_code_data_query) ; 
            
            $Fetch_code_data_query_result = mysqli_fetch_assoc($Fetch_code_data_query_result) ; 
            
            // Get Commentcolumnvalue 

            // Get username 

            $Fetch_username = explode("-",$Fetch_codeid)[0] ; 

            // ADD ALL CODEDATA IN ARRAY 

            $Fetch_data_store_array = array($Fetch_codeid , $Fetch_code_data_query_result["Codetitle"] , $Fetch_code_data_query_result["Codelanguage"], $Fetch_username,$Fetch_code_data_query_result["Commentusername"] ,
            $Fetch_code_data_query_result["Commentvalue"], $Fetch_code_data_query_result["Codelike"],$Fetch_code_data_query_result["Code"],  $Fetch_code_data_query_result["Problemvalue"]) ; 

            // APPEND SEARCH DATA IN MAIN STORE ARRAY 

            array_push($Session_variable_store_array, $Fetch_data_store_array) ; 
        }

        // HERE, WE STORE OTHER CODEID 

        $Other_remaning_codeid_length = $Codeid_array_length - 15 ; 


        for($i=15 ; $i<$Other_remaning_codeid_length ; $i++){

            // READ CODEID 

            $Other_code_id = $Codeid_store_array[$i] ; 

            // ADD THIS CODEID INTO ARRAY 

            array_push($Session_store_other_codeid , $Other_code_id) ; 
        }

        // SET THIS ARRAY INTO SESSION VARIABLE 
        
        $_SESSION["Search-data-other-codeid"] = $Session_store_other_codeid ; 
    }

    else{

        // HERE, WE FETCH CODE DATA FROM 'coddata' table 

        for($i=0 ; $i<$Codeid_array_length ; $i++){
           
            // Read codeid 

            $Fetch_codeid = $Codeid_store_array[$i] ;       
            
            $Fetch_code_data_query = "SELECT `Codetitle`, `Codelanguage`, `Codelike` , `Problemvalue` , `Code`, `Commentusername` , `Commentvalue` FROM `codedata` WHERE `Codeid` = '$Fetch_codeid' " ; 

            $Fetch_code_data_query_result = mysqli_query($Database_connection , $Fetch_code_data_query) ; 
            
            $Fetch_code_data_query_result = mysqli_fetch_assoc($Fetch_code_data_query_result) ; 
            
            // Get Commentcolumnvalue 

            // Get username 

            $Fetch_username = explode("-",$Fetch_codeid)[0] ; 

            // ADD ALL CODEDATA IN ARRAY 

            $Fetch_data_store_array = array($Fetch_codeid , $Fetch_code_data_query_result["Codetitle"] , $Fetch_code_data_query_result["Codelanguage"], $Fetch_username,$Fetch_code_data_query_result["Commentusername"] ,
            $Fetch_code_data_query_result["Commentvalue"], $Fetch_code_data_query_result["Code"],$Fetch_code_data_query_result["Codelike"],  $Fetch_code_data_query_result["Problemvalue"]) ; 

            // APPEND SEARCH DATA IN MAIN STORE ARRAY 

            array_push($Session_variable_store_array, $Fetch_data_store_array) ; 
        }
    }

    // SET FINDING DATA INTO SESSION VARIABLE AS ARRAY 

    $_SESSION["search-data-array"] = $Session_variable_store_array ; 

    $Usersarch_table_update_value = join("**", $Usersearch_table_array) ; 

    // --- Now Update user data in usersearch table 

    $Usersearch_table_update_data_query = "UPDATE `usersearch` SET  `searchvalue` = '$Usersarch_table_update_value' WHERE `Username` = '$Username' " ; 

    $Usersearch_table_update_data_query_result = mysqli_query($Database_connection , $Usersearch_table_update_data_query) ; 
    
    $_SESSION["Search-result"] = 1 ; 
    
    echo "Find" ; 
}

else{
    echo "Notfind" ; 
}

?>