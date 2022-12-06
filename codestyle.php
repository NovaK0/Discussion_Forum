<?php

// ---- Setup sql connection ---- // 

include "Sql_connection/sql_connection.php" ; 


session_start() ; 

// --- Character color array --- // 

$Color_information_array = array(
    "A"=>"#b6b6b6",
    "B"=> "#878787",
    "C"=>"#ffa87d",
    "D"=>"#f27a3e",
    "E"=>"#f98888",
    "F" =>"#ff6161",
    "G"=> "#ffcd87",
    "H" => "#f3a231",
    "I" => "#f0ee75",
    "J" => "#cae86f",
    "L" => "#a5dd76",
    "K" => "#29d27b",
    "M" => "#88e53c",
    "N" => "#79dd89",
    "O"=> "#37e254",
    "P" => "#68ddb0",
    "Q" => "#03e48e",
    "R" => "#74d7c3",
    "S" => "#00e6b8",
    "T" => "#a992d9",
    "U" => "#9165f0",
    "V" => "#d77070",
    "W" => "#b573cb",
    "X" => "#e9a7ff",
    "Y" => "#a100d6",
    "Z" => "#ca88c6",
    "1" => "#ff71b5",
    "2" => "#ff7171",
    "3"=> "#f5acac",
    "4" => "#8a8a8a",
    "5" => "#e89b00",
    "6" => "#8870d7",
    "7" => "#70d7aa",
    "8" => "#d77094",
    "9" => "#8a70d7",
    "0" => "#93dadb",
    "!" => "#70d56c",
    "@" => "#d56cb8", 
    "#" => "#d56cb8", 
    '$' => "#fecc37",
    "%" => "#e3996f",
    "^" => "#e36f6f",
    "&" => "#826fe3", 
    "(" => "#e36f6f",
    ")" => "#e3d96f",
);

// ---- Code language color ---- // 

$Code_language_color_array = array(
    "C" => "#eab96f" , 
    "C++" => "#ea796f", 
    "Python" => "#6fea88", 
    "Javascript" => "#ea6fa0", 
    "PHP" => "#9c6fea",
    "Ruby" => "#44d5c9" ,
    "HTML/CSS" => "#910bcf",
    "Java" => "#f0adde", 
    "SQL" => "#57ae74", 
    "Arduino" => "#9da4f0", 
    "Other" => "#f09d9d"
) ; 

$Id_value = $_COOKIE["id"] ; 

$Get_username_query = "SELECT `Username` FROM `userdata` WHERE `Id` = '$Id_value' " ; 

$Get_username_query_result = mysqli_query($Database_connection , $Get_username_query) ; 

$Get_username_query_result = mysqli_fetch_assoc($Get_username_query_result) ; 

$Username = $Get_username_query_result["Username"];

$_SESSION["username"] = $Username ; 

$Code_data_array = array() ; 


// ---- FUNCTIONALITY WHICH GET CODEDATA USING 'usersearch' TABLE ---- 

$Usersearch_table_query = "SELECT `searchvalue` FROM `usersearch` WHERE `Username` = '$Username' " ; 

$Usersearch_table_query_result = mysqli_query($Database_connection , $Usersearch_table_query) ; 

$Usersearch_table_query_result = mysqli_fetch_assoc($Usersearch_table_query_result) ; 

$Search_data = $Usersearch_table_query_result["searchvalue"] ; 

// Array which store `usersearch` table codeid 

$Search_data = explode("**", $Search_data) ; 

for($i=0 ; $i<count($Search_data); $i++){

    // Read codeid 

    $Codedata_codeid = $Search_data[$i] ; 

    // Fetch codedata from `codedata` table 

    $Codedata_table_query = "SELECT `Codetitle`, `Codelanguage`,  `Codelike` , `Problemvalue` , `Code`  , `Commentusername`, `Commentvalue` 
    FROM `codedata` WHERE `Codeid` = '$Codedata_codeid' " ;
    
    $Codedata_table_query_result = mysqli_query($Database_connection , $Codedata_table_query) ; 

    $Codedata_table_query_result = mysqli_fetch_assoc($Codedata_table_query_result) ; 

    // Get username using codeid 

    $Code_username = explode("-", $Codedata_codeid)[0] ;

    // Add all value in one array 

    $Code_array = array($Codedata_codeid ,$Codedata_table_query_result["Codetitle"] , $Codedata_table_query_result["Codelanguage"] , $Code_username , $Codedata_table_query_result["Commentusername"] , 
    $Codedata_table_query_result["Commentvalue"] , $Codedata_table_query_result["Code"] , $Codedata_table_query_result["Codelike"], $Codedata_table_query_result["Problemvalue"]) ; 

    array_push($Code_data_array , $Code_array) ;
}


// --- Variable for show code data ---- // 

// 1. Store code unique id 

$Code_unique_id ; 

// 2. Store code title

$Code_title ; 

// 3. Store code language 

$Code_language ; 

// 4. Store code owner name 

$Code_owner_name ; 

// 5. Store last comment sender name 

$Code_last_comment_sender_name ; 

// 6. Store last comment value 

$Code_last_comment_value ; 

// 7. Store code 

$Code ; 

// 8. Store code like value 

$Code_like_value ; 

// 9. Store code data i value 

$Code_data_i_value ; 

// 10. Store code problem value 

$Code_problem_value ; 

// 11. Store code like image value 

$Code_like_image_value  ; 


// ---- Functionailty which get user account information ---- // 

// 1. Get Emailaddress 

$Emailaddress ; 

// 2. Get Twitter username 

$Twitter_username ; 

// 3. Get Instagram username 

$Instagram_username  ; 

// 4. Get website url 

$Website_url ; 

// 5. Likecount value 

$Likecount_value ; 

function Get_account_information(){

    global $Username ; 
    global $Database_connection ; 
    global $Emailaddress ; 
    global $Twitter_username ; 
    global $Instagram_username ; 
    global $Website_url ; 
    global $Likecount_value ;

    $Get_account_information_query = "SELECT `Emailaddress`, `Instagram`, `Twitter`, `Weburl`, `Likecount` FROM `userdata` WHERE `Username` = '$Username' " ; 

    $Get_account_information_query_result = mysqli_query($Database_connection , $Get_account_information_query) ; 
    
    $Get_account_information_query_result = mysqli_fetch_assoc($Get_account_information_query_result) ; 

    $Emailaddress = $Get_account_information_query_result["Emailaddress"] ; 

    $_SESSION["Emailaddress"] = $Emailaddress ; 
    
    $Twitter_username = $Get_account_information_query_result["Twitter"] ; 

    $_SESSION["Twitter"] = $Twitter_username ; 
    
    $Instagram_username = $Get_account_information_query_result["Instagram"] ; 

    $_SESSION["Instagram"] = $Instagram_username ; 
    
    $Website_url = $Get_account_information_query_result["Weburl"] ; 

    $_SESSION["Websiteurl"] = $Website_url ; 

    $Likecount_value = $Get_account_information_query_result["Likecount"] ; 
}

Get_account_information() ; 


// --- Function which set all codelike data 


// Array which store all like codeid 

$All_like_codeid_array = array() ; 

function Get_all_like_code_data(){

    global $Likecount_value ; 
    global $All_like_codeid_array ; 
    global $Username ; 
    global $Database_connection ; 

    // Fetch codelike dislike data in `userlikedislike` table 

    for($i=0 ; $i<intval($Likecount_value) +1; $i++){

        // Create unique id for `codelikedislike` table 

        $Code_like_dislike_table_unique_id = $Username."-".$i ; 

        $Fetch_code_like_dislike_data_query = "SELECT * FROM `userlikedislike` WHERE `Username` = '$Code_like_dislike_table_unique_id' " ;
        
        $Fetch_code_like_dislike_data_query_result = mysqli_query($Database_connection , $Fetch_code_like_dislike_data_query) ; 

        $Fetch_code_like_dislike_data_query_result = mysqli_fetch_assoc($Fetch_code_like_dislike_data_query_result) ; 

        // Get count value 

        $Count_value = intval($Fetch_code_like_dislike_data_query_result["Count"]) ; 

        for($i=1 ;$i<intval($Count_value)+1; $i++){
            
            // Create username column name 

            $Username_column_name = "U".$i ; 

            $Data = $Fetch_code_like_dislike_data_query_result[$Username_column_name] ; 

            // Read data 

            $First_attributes = explode("**" , $Data)[0] ; 

            $Like_codeid = explode("**", $Data)[1] ; 

            $Like_codeid = strval($Like_codeid) ; 

            if($First_attributes != "D"){

                $Like_codeid = trim($Like_codeid) ; 
                array_push($All_like_codeid_array , $Like_codeid) ; 
            }

            else{}

        }
    }
}

Get_all_like_code_data() ;

$_SESSION['Like-codeid-data'] = $All_like_codeid_array ; 

$_SESSION["Search-result"] = 0 ; 


// ----- Variable for all comment data show related variable 


// 1. Store Comment sender name 

$Comment_sender_name ; 

// 2. Store Comment date and time 

$Comment_date_and_time ; 

// 3. Store Comment sender first attributes 

$Comment_sender_first_attributes ; 

// 4. Store Comment value 

$Comment_value ; 


// ---- Variable for All code list data ----- //


// 1. Store Codelike title 

$List_code_title ;

// 2. Store Codeid 

$List_code_id ; 

// 3. Store Codelanguage 

$List_codelanguage; 

// 4. Store Codelike 

$List_codelike ; 

// 5. Store Codeproblemvalue 

$List_codeproblem_value ; 

// 6. Store Codelist data i value 

$List_codedata_i_value ; 

// 7. Store Codetitle first character 

$List_code_first_character ; 

// 8. Store main code

$List_code ;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="codestyle.css">
    <link rel="stylesheet" href="prism.css">
    <title>Codestyle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Mukta&display=swap" rel="stylesheet">
    
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
     
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
    
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Mukta&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Karla:wght@300&display=swap" rel="stylesheet">

</head>
<body>

    <div class="Main_container">

        <div id="User_information_division">
            
            <!-- Web logo and name division  -->

            <div id="Logo_name_division">
                  
                <img src="./Logo/Website-logo.png" alt="" id="Logo_division">

                <div id="Logo__name__division">
                    Codestyle
                </div>

            </div>
            
            <!-- Username information division  -->

            <div id="Username_information_division"
            onclick="Set_account_details_division_function()">
               
                <img src="Images/User_icon.ico" alt="" id="Username_information__image">
                
                <div id="Username_information__name">
                    <?php global $Username ; echo $Username ;  ?>
                </div>
            </div>

            <div id="Upload_code_button_main_division">
                
                <div id="Upload_code_button"
                onclick="Set_upload_code_division()">
                    + Upload code 
                </div>
                
            </div>

            <div id="All_website_option_list_division">

                <div class="list_division"
                onclick="Set_code_list_option_function()">
                    <img src="./Images/Codelist.ico" alt="" class="List_image">
                    <div class="List_name_division">Upload code list </div>
                </div>

                <div class="list_division"
                onclick="Set_account_setting_division()">
                    <img src="./Images/Setting.ico" alt="" class="List_image">
                    <div class="List_name_division">Setting</div>
                </div>


            </div>

        </div>
        
        <div id="Code_information_division">

            <!-- Searching menu division  -->

            <div id="Searching_menu_division">

                <button id="Search_button">
                    <img src="./Images/Search.ico" alt="" id="Search_image"
                    onclick="Search_data_function()">
                </button>

                <input type="text" id="Search_input_widget" placeholder=" Search...">
            
            </div>

            <!-- Code list division  -->

            <div id="Code_list_main_division">
                   
                <?php
                
                global $Code_data_array ; 

                global $Code_unique_id ; 
                global $Code_title ; 
                global $Code_language ; 
                global $Code_owner_name ; 
                global $Code_last_comment_sender_name ; 
                global $Code_last_comment_value ; 
                global $Code ; 
                global $Code_data_i_value ; 
                global $Code_dislike_value ; 
                global $Code_like_image_value ; 

                if($_SESSION["Search-result"] == 1){
                    
                    $_SESSION["Back-up-data"] = $Code_data_array ; 

                    unset($Code_data_array) ; 

                    $Code_data_array = $_SESSION["search-data-array"] ; 
                }

                else{}
                
                for($i = 0 ; $i<count($Code_data_array); $i++){

                    $Code_unique_id = $Code_data_array[$i][0] ; 

                    $Code_title = $Code_data_array[$i][1] ; 

                    $Code_language = $Code_data_array[$i][2] ; 

                    $Code_owner_name = $Code_data_array[$i][3] ; 

                    $Code_last_comment_sender_name = $Code_data_array[$i][4] ; 

                    $Code_last_comment_value = $Code_data_array[$i][5] ; 

                    $Code = $Code_data_array[$i][6] ; 

                    $Code_like_value = $Code_data_array[$i][7] ; 

                    $Code_problem_value = $Code_data_array[$i][8] ; 

                    $Code_data_i_value = $i ; 
                    
                    if(in_array($Code_unique_id, $_SESSION["Like-codeid-data"])){

                        $Code_like_image_value = 1 ; 
                    } 

                    else{

                        $Code_like_image_value = 0 ;

                    }
                    ?>

                    <div class="Code_main_division">

                        <div class="Code_division__title">

                            <?php
                            global $Code_title ; 
                            echo $Code_title  ; 
                            ?>

                        </div>

                        <div class="Code_division__other_information">
    
                            <div class="Code_division_language_owner_name_information">
       
                                <div class="Code_division__language_information" 
                                style = "color:<?php global $Code_language_color_array ; global $Code_language ; 
                                echo $Code_language_color_array[$Code_language]; ?>">
                                    <?php
                                    global $Code_language ; 
                                    echo $Code_language ; 
                                    ?>
                                </div>

                                <div class="Code_division__owner_information"
                                onclick="Set_code_owner_data_function('<?php global $Code_like_value ; echo $Code_like_value ; ?>', 
                                '<?php global $Code_owner_name ; echo $Code_owner_name ; ?>')">
                                    <?php
                                    global $Code_owner_name ; 
                                    echo $Code_owner_name ; 
                                    ?>
                                </div>

                            </div>

                            <div class="Code_comment_division">

                                <img src="./Images/Comment.ico" alt="" class="Comment_image"
                                onclick="Fetch_all_commentdata_function('<?php global $Code_unique_id; echo $Code_unique_id ; ?>',
                                '<?php global $Code_title ; echo $Code_title ; ?>')">
         
                                <div class="Code_comment_username_comment_value_division">
                                    <div class="Code_comment_username">
                                        <?php global $Code_last_comment_sender_name ; 
                                        echo $Code_last_comment_sender_name ; ?>
                                    </div>
                                    <div class="Code_comment_value">
                                        <?php global $Code_last_comment_value ; 
                                        echo $Code_last_comment_value ; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="Store_code_division">

                            <div class="Code_division__main_code">

                                <pre class="Code_data_division">
                                    <code class="language-css">
                                    <?php
                                    global $Code ;
                                    echo " \n";
                                    echo strip_tags($Code) ; 
                                    ?>
                                    </code>
                                </pre>

                            </div>
        
                            <div class="Like_dislike_comment_division">

                                <div class="Like_division">
                                    <?php
                                    global $Code_like_image_value ; 
                                    global $Code_data_i_value ; 

                                    if($Code_like_image_value == 1){
                                        ?>
                                        <img src="./Images/Activelike.ico" alt="" class="Like_button_image"
                                        onclick="Do_like_function('<?php global $Code_data_i_value ; echo $Code_data_i_value ;?>', 
                                        '1', '<?php global $Code_unique_id ; echo $Code_unique_id ;  ?>')">
                                        <?php
                                    }

                                    else{
                                        
                                        ?>
                                        <img src="./Images/Like.ico" alt="" class="Like_button_image"
                                        onclick="Do_like_function('<?php global $Code_data_i_value ; echo $Code_data_i_value ; ?>', '0' , 
                                        '<?php global $Code_unique_id ; echo $Code_unique_id ;?>')">
                                        <?php
                                    }

                                    ?>
                                </div>
                            
                                <div class="Send_comment_division">
                                    <button class="Comment_send_button"
                                    onclick="Set_comment_send_button_division_function('<?php global $Code_unique_id ; echo $Code_unique_id ; ?>', '<?php global $Code_data_i_value ; echo $Code_data_i_value ; ?>')">Send comment</button>
                                </div>

                            </div> 


                        </div>

                    </div>

                <?php

                }
                ?>
                 
            </div>
            
            <div id="All_code_list_division">

                <?php
                
                global $List_code_title ; 
                global $List_code_id ; 
                global $List_codelanguage ; 
                global $List_codelike ; 
                global $List_codeproblem_value ; 
                global $List_codedata_i_value ;
                global $List_code_first_character ;
                global $List_code ; 

                for($i=0 ; $i<count($_SESSION["All-code-list-data-array"]) ; $i++){

                    // Read code data 

                    $Code_data = $_SESSION["All-code-list-data-array"][$i] ; 

                    // Get Codeunique id  

                    $List_code_id = $Code_data[0] ; 

                    // Get Codetitle 

                    $List_code_title = $Code_data[1] ; 
 
                    $List_code_first_character = substr($List_code_title,0,1) ; 
                    $List_code_first_character = strtoupper($List_code_first_character) ; 

                    // Get Codelanguage

                    $List_codelanguage = $Code_data[2] ; 

                    // Get Code 

                    $List_code = $Code_data[3] ; 

                    // Get Codelikevalue 

                    $List_codelike = $Code_data[4] ; 

                    // Get Codeproblemvalue 

                    $List_codeproblemvalue = $Code_data[5] ; 

                    ?>

                    <div class="All_code_list_data_division">

                        <!-- Codelike firstname character value  -->

                        <div class="All_code_list_data_first_name_division" style="
                        background-color:<?php global $Color_information_array ; $List_code_first_character ; 
                        echo $Color_information_array[$List_code_first_character] ; ?>">
                        
                            <div class="All_code_list_data_first_name">
                                <?php global $List_code_first_character ; echo $List_code_first_character ;?>
                            </div>
                        
                        </div> 

                        <div class="All_code_list_other_data">
                        
                            <div class="All_code_list_data_title">
                                <?php global $List_code_title ; echo $List_code_title ;?>
                            </div>
                            
                            <div class="All_code_list_option_division">
                      
                                <img src="./Images/Comment.ico" alt="" class="All_code_list_comment_option">
                      
                                <div class="All_code_list_language_option" style="color:<?php global $List_codelanguage ; global $Code_language_color_array ;
                                echo $Code_language_color_array[$List_codelanguage] ; ?>">
                                    <?php global $List_codelanguage ; echo $List_codelanguage ; ?>
                                </div>
                                
                                <div class="All_code_list_like_option">
                                    Like = <?php global $List_codelike ; echo $List_codelike ; ?>
                                </div>
                      
                            </div>
                       
                        </div>
              
                    </div>
                    
                    <?php
                }
                ?>

            </div>

        </div>
    </div>
    
    <!-- Upload code division  -->

    <div id="Send_code_background_division">
        
        <div id="Send_code_division">

            <div class="Send_code_division__title">

                <div class="Title">
                    Upload your code
                </div>

                <div class="Send_code_division__close"
                onclick="Close_upload_code_division()">
                    X
                </div>

            </div>
            
            <!-- Take codetitle  -->

            <div class="Send_code_lable">Code title</div>
            <input type="text" name="" id="Code_title_input" class="Send_code_division_all_input_widget">
            
            <!-- Codetitle error message division  -->

            <div class="Send_code_division_error_message"></div>
            
            <!-- Choose language option  -->

            <div class="Send_code_lable">Choose language</div>

            <select name="pets" id="Code_language_select">
                <option value="">--Please choose an option--</option>
                <option value="C">C</option>
                <option value="C++">C++</option>
                <option value="Python">Python</option>
                <option value="Javascript">Javascript</option>
                <option value="PHP">PHP</option>
                <option value="Ruby">Ruby</option>
                <option value="HTML/CSS">HTML/CSS</option>
                <option value="Java">Java</option>
                <option value="SQL">SQL</option>
                <option value="Arduino">Arduino</option>
                <option value="Other">Other language </option>
            </select>
            
            <div class="Send_code_division_error_message"></div>

            <!-- Take main code  -->

            <div class="Send_code_lable">Code</div>
            <textarea name="" id="Code_textarea" cols="30" rows="10"></textarea>
            
            <div class="Send_code_division_error_message"></div>
            
            <!-- Take check value for upload code for any problem  -->

            <div id="Sendcode_checkbox_main_division">
                    
                <input type="checkbox" name="" id="Code_for_problem_input_widget" value="1">
                
                <div id="Checkbox_information_division">
                    Upload for getting problem solution
                </div>

            </div>            
            
            <!-- Keywords take  -->

            <div class="Send_code_lable">Enter keywords for searching </div>
        
            <div id="Code_keyword_information">Separate all keywords with comma (,) | Using this keywords we search result for other</div>
            
            <input type="text" name="" id="Keywords_input" class="Send_code_division_all_input_widget">
             
            <div class="Send_code_division_error_message"></div>

            <!-- Upload code main button  -->

            <button id="Send_code_button">Upload</button>
            
            <!-- Loading spinner division  -->

            <div class="Spinner_division">

                <div class="spinner-border" role="status">
                </div>
                <div class="Spinner_text_information">
                   Uploading...
                </div>

            </div>

        </div>
    </div>

    <!-- Account setting division  -->

    <div id="Account_setting_background_division">

        <div id="Account_setting_division">

            <div class="Send_code_division__title">
            
                <div class="Title">Account setting</div>
                <div class="Send_code_division__close"
                onclick="Disable_account_setting_division()">X</div>
            
            </div>

            <!-- Username information  -->

            <div id="Account_username_information_division">
            
                <img src="./Images/User_icon.ico" alt="" id="Account_username__image"
                onclick="Set_update_password_division()">
                
                <div id="Account_username_changeoption_name">
                    <div id="Account_username__name">
                        <?php global $Username ; echo $Username ; ?>
                    </div>
                </div>
           
            </div>

            <!-- Update emailaddress option  -->

            <div class="All_account_setting_option_division">

                <div class="All_account_setting_option_title">
                    Email address
                </div>

                <div class="All_account_setting_change_option_division">

                    <img src="./Images/Editcode.ico" alt="" class="Change_option_image"
                    onclick="Set_update_email_division()">
                    
                    <div class="All_account_change_information_division">
                        <?php echo $_SESSION["Emailaddress"] ;  ?>
                    </div>
                
                </div>
           
            </div>

            <!-- Update password option  -->

            <div class="All_account_setting_option_division">
                
                <div class="All_account_setting_option_title">
                    Password
                </div>
                
                <div class="All_account_setting_change_option_division">
                    
                    <img src="./Images/Editcode.ico" alt="" class="Change_option_image"
                    onclick="Set_update_password_division()">
                    
                    <div class="All_account_change_information_division">
                        Update password
                    </div>

                </div>

            </div>


            <!-- Update instagram username option  -->

            <div class="All_account_setting_option_division">

                <div class="All_account_setting_option_title">
                    Set Instagram username
                </div>

                <div class="All_account_setting_change_option_division">
                
                    <img src="./Images/Editcode.ico" alt="" class="Change_option_image"
                    onclick="Set_instagram_username_division()">
                    
                    <div class="All_account_change_information_division">
                        <?php echo $_SESSION["Instagram"] ;  ?>
                    </div>

                </div>

            </div>

            <!-- Update Twitter username option  -->

            <div class="All_account_setting_option_division">

                <div class="All_account_setting_option_title">
                    Set Twitter username
                </div>
                
                <div class="All_account_setting_change_option_division">
                    
                    <img src="./Images/Editcode.ico" alt="" class="Change_option_image"
                    onclick="Set_twitter_username_division()">
                   
                    <div class="All_account_change_information_division">
                        <?php echo $_SESSION["Twitter"] ;  ?>
                    </div>

                </div>

            </div>

            <!-- Update websiteurl option  -->

            <div class="All_account_setting_option_division">

                <div class="All_account_setting_option_title">
                    Set website url
                </div>

                <div class="All_account_setting_change_option_division">
                     
                    <img src="./Images/Editcode.ico" alt="" class="Change_option_image"
                    onclick="Set_website_url_division()">
                    
                    <div class="All_account_change_information_division">
                        <?php echo $_SESSION["Websiteurl"]  ; ?>
                    </div>
           
                </div>
            
            </div>
        
        </div>
    
    </div>

    <!-- Update emailadderss background division  -->

    <div id="Update_emailaddress_background_division">
           
        <div class="Update_data_division">
            <div class="Send_code_division__title">
                <div class="Title">Update email address</div>
            </div>

            <input type="email" id="Update_email_input" class="Update_input_widget"
            placeholder="Enter email address">

            <div class="Update_data_error_message_division"></div>

            <div class="Update_save_close_button_division">

                <div class="Update_cancel_division"
                onclick="Disable_update_email_division()">CANCEL</div>
                <div class="Update_save_division"
                onclick="Set_verification_code_function()">VERIFY</div>

            </div>

        </div>

    </div>

    <!-- Update emailaddress verify division  -->

    <div id="Update_email_verify_background_division">

        <div class="Update_data_division">

            <div class="Send_code_division__title">
               <div class="Title">Verify email address</div>
            </div>

            <input type="text" id="Update_email_code" class="Update_input_widget"
            placeholder="Enter verification code">

            <div class="Update_data_error_message_division"></div>

            <div class="Update_save_close_button_division">

                <div class="Update_cancel_division"
                onclick="Disable_email_verification_code_division()">CANCEL</div>
                <div class="Update_save_division"
                onclick="Update_email_database_function()">SAVE</div>

            </div>
        </div>

    </div>
    
    <!-- Update Instagram username division  -->
    
    <div id="Update_instagram_username_division">

        <div class="Update_data_division">

            <div class="Send_code_division__title">
                <div class="Title">Set Instagram username</div>
            </div>

            <input type="text" id="Instagram_username_value" class="Update_input_widget"
            placeholder="Enter username">

            <div class="Update_data_error_message_division"></div>

            <div class="Update_save_close_button_division">

                <div class="Update_cancel_division"
                onclick="Disable_instagram_username_division()">
                    CANCEL
                </div>

                <div class="Update_save_division"
                onclick="Set_instagram_username_function()">
                    SAVE
                </div>

            </div>
        </div>
    </div>

    <!-- Update Twitter username division  -->

    <div id="Update_twitter_username_division">

        <div class="Update_data_division">

            <div class="Send_code_division__title">
                <div class="Title">Set Twitter username</div>
            </div>
            
            <input type="text" id="Twitter_username" class="Update_input_widget"
            placeholder= "Enter username">

            <div class="Update_data_error_message_division"></div>

            <div class="Update_save_close_button_division">

                <div class="Update_cancel_division"
                onclick="Disable_twitter_username_division()">
                    CANCEL
                </div>

                <div class="Update_save_division"
                onclick="Update_twitter_username_in_database()">
                    SAVE
                </div>
            
            </div>
        </div>

    </div>

    <!-- Update websiteurl background division  -->

    <div id="Update_weburl_division">

        <div class="Update_data_division">

            <div class="Send_code_division__title">
                <div class="Title">Set website url</div>
            </div>

            <input type="url" id="Update_website_url" class="Update_input_widget"
            placeholder="Enter website url">

            <div class="Update_data_error_message_division"></div>

            <div class="Update_save_close_button_division">

                <div class="Update_cancel_division"
                onclick="Disable_website_url_division()">CANCEL</div>

                <div class="Update_save_division"
                onclick="Update_website_url_in_database()">SAVE</div>

            </div>

        </div>
    </div>
    
    <!-- Update password option division  -->

    <div id="Update_password_division">

        <div class="Update_data_division">

            <div class="Send_code_division__title">
                <div class="Title">Update Password</div>
            </div>

            <form action="#">
            
                <input type="password" id="Account_update_password" class="Update_input_widget"
                placeholder="Enter password">
                <div class="Update_data_error_message_division"></div>
                <input type="password" id="Account_re-enter_password" class="Update_input_widget"
                placeholder="Re-enter password">
            
            </form>

            <!-- Error message information division  -->

            <div class="Update_data_error_message_division"></div>

            <div class="Update_save_close_button_division">

                <div class="Update_cancel_division"
                onclick="Close_update_password_division()">CANCEL</div>
                
                <div class="Update_save_division"
                onclick="Update_password_function()">SAVE</div>

            </div>
        </div>
    </div>

    <!-- Account information division  -->

    <div id="Account_details_information_background_division">

        <div id="Account_details_information_division">

            <div class="Send_code_division__title">

                <div class="Title">Account information</div>
                <div class="Send_code_division__close"
                onclick="Disbale_account_details_division_function()">X</div>
            
            </div>

            <!-- Username information division  -->

            <div class="Account_details__division">

                <img src="./Images/User_icon.ico" alt="" class="Account_details__division_image">
                <div class="Account_details__division_name">
                    <?php global $Username ; echo $Username ; ?>
                </div>
            
            </div>

            <!-- Emailaddress information division  -->

            <div class="Account_details__division">
            
                <img src="./Images/Email.ico" alt="" class="Account_details__division_image">
                <div class="Account_details__division_name">
                    <?php echo $_SESSION["Emailaddress"] ; ?>
                </div>
            
            </div>

            <!-- Twitter username information division  -->

            <div class="Account_details__division">

                <img src="./Images/Twitter.ico" alt="" class="Account_details__division_image">
                <div class="Account_details__division_name">
                    <?php  echo $_SESSION["Twitter"] ; ?>
                </div>
                
            </div>

            <!-- Instagram username information division  -->

            <div class="Account_details__division">

                <img src="./Images/Instagram.ico" alt="" class="Account_details__division_image">
                <div class="Account_details__division_name">
                    <?php echo $_SESSION["Instagram"] ;  ?>
                </div>
            
            </div>

            <!-- Websiteurl information division  -->

            <div class="Account_details__division">
            
                <img src="./Images/Website.ico" alt="" class="Account_details__division_image">
                <div class="Account_details__division_name">
                    <?php echo $_SESSION["Websiteurl"] ;  ?>
                </div>
            
            </div>

        </div>

    </div>
    
    <!-- Codeinformation division  -->

    <div id="Code_information_background_division">
        
        <div id="Code_information_main_division">
             
            <div class="Send_code_division__title">
                <div class="Title">Code data</div>
                <div class="Send_code_division__close">X</div>
            </div>

            <div id="Code_information_main_division_codetitle">

                <div class="Code_information_main_division__title">
                   Code title 
                </div>
                
                <div id="Code_information_main_division_codetitle_data">
                    sdfodsjgdjfgsdfjogs
                </div>

            </div>

            <div id="Main_code_information_division">

                <div class="Code_information_main_division__title">
                    Code
                </div>

                <div id="Main_code_information_data">
                    
                    <pre>
                    
                    </pre>
                
                </div>
            
            </div>

        </div>
    
    </div>

    <div id="Send_comment_background_division">
        <div id="Send_comment_division">
            <textarea id="Send_comment_textarea" ></textarea>
            <div id="Comment_division_error_message"></div>
            <div id="Comment_send_close_button_division">
                <div id="Comment_send_button_division"
                onclick="Send_comment_function()">SEND</div>
                <div id="Comment_close_button_division"
                onclick="Close_comment_send_button_division_function()">CANCEL</div>
            </div>
        </div>
    </div>

    <div id="Notification_message_division">
    </div>

    <div id="Code_owner_information_division">
        
        <div id="Code_owner_data_division">

            <div class="Send_code_division__title">

                <div class="Title">Code uploader information</div>
                <div class="Send_code_division__close"
                onclick="Close_code_owner_data_division_function()">X</div>

            </div>

            <!-- Username information division  -->

            <div class="Code_owner_information_division">

                <img src="./Images/User_icon.ico" alt="" class="Code_owner_division_image">

                <div class="Code_owner_information__name">
                    <?php echo $_SESSION["Owner-username"] ; ?>
                </div>

            </div>

            <!-- Instagram username information division  -->

            <div class="Code_owner_information_division">

                <img src="./Images/Instagram.ico" alt="" class="Code_owner_division_image">

                <div class="Code_owner_information__name">
                   <?php echo $_SESSION["Owner-instagram"] ; ?>
                </div>
                
            </div>

            <!-- Twitter username information division  -->

            <div class="Code_owner_information_division">

                <img src="./Images/Twitter.ico" alt="" class="Code_owner_division_image">

                <div class="Code_owner_information__name">
                    <?php echo $_SESSION["Owner-twitter"] ; ?>
                </div>

            </div>
 
            <!-- Websiteurl information division  -->

            <div class="Code_owner_information_division">

                <img src="./Images/Website.ico" alt="" class="Code_owner_division_image">

                <div class="Code_owner_information__name">
                    <?php echo $_SESSION["Owner-weburl"]; ?>
                </div>

            </div>

            <!-- Codelike information division  -->
            
            <div class="Code_owner_information_division">

                <img src="./Images/Like.ico" alt="" class="Code_owner_division_image">

                <div class="Code_owner_information__name">
                    <?php echo $_SESSION["Owner-codelike"] ; ?>
                </div>

            </div>

        </div>

    </div>

    <div id="Show_all_comment_background_division">

        <div id="All_comment_data_division">

            <div class="Send_code_division__title">

                <div class="Title">
                    <?php echo $_SESSION["All-comment-data-title"] ; ?>
                </div>

                <div class="Send_code_division__close"
                onclick="Close_all_commentdata_division_function()">
                    X
                </div>
            
            </div>

            <?php
            
            global $Comment_sender_name ; 
            global $Comment_sender_first_attributes ; 
            global $Comment_value ;
            global $Comment_date_and_time ; 

            for($i=0 ; $i<intval($_SESSION["All-comment-data-length"]) ; $i++){

                // Get comment data 

                $Comment_data = $_SESSION["All-comment-data"][$i] ; 

                // Get Comment sender name 
                $Comment_sender_name = $Comment_data[0] ; 
                
                // Set comment ssender username first attributes 

                $Comment_sender_first_attributes = substr($Comment_sender_name,0,1) ; 
                $Comment_sender_first_attributes = strtoupper($Comment_sender_first_attributes) ; 

                // Get comment date and time 

                $Comment_date_and_time = $Comment_data[1] ; 

                // Get comment value 

                $Comment_value = $Comment_data[2] ; 

                ?>

                <div class="Show_comment_data_division">

                    <div class="Comment_username_first_character_division"
                    style = "background-color : <?php global $Color_information_array ; 
                    global $Comment_sender_first_attributes ; echo $Color_information_array[$Comment_sender_first_attributes] ;?>">

                        <div class="Comment_sender_name_division">
                            <?php global $Comment_sender_first_attributes ; echo $Comment_sender_first_attributes ; ?>
                        </div>

                    </div>

                    <div class="Username_commentvalue_division">

                        <div class="Comment_username_name_division">
                        
                            <div class="Comment_username_division">
                                <?php global $Comment_sender_name ; echo $Comment_sender_name ; ?> |
                            </div>
                        
                            <div class="Comment_date_division">
                                <?php global $Comment_date_and_time ; echo $Comment_date_and_time ; ?>
                            </div>
                        
                        </div>

                        <div class="Comment_data_division">
                            <?php global $Comment_value ; echo $Comment_value ; ?>
                        </div>

                    </div>

                </div>
                
                <?php

            }
            
            ?>

        </div>
    </div>

    <script src="prism.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="codestyle.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
</body>
</html>