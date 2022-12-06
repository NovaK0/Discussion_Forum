
// Function which set upload code division

function Set_upload_code_division(){

    $("#Send_code_background_division").css("display", "block") ; 
}

// Function which close upload code division 

function Close_upload_code_division(){
    $("#Send_code_background_division").css("display", "none") ; 
}

// Funtion which upload code in database  // 

$(document).ready(function(){

    $("#Send_code_button").click(function(event){

        event.preventDefault() ; 

        // Get code title 

        var Code_title = document.getElementById("Code_title_input").value ; 

        // Get code language selected value 

        var Code_language = document.getElementById("Code_language_select").value  ; 

        // Get code 

        var Main_code = document.getElementById("Code_textarea").value ; 

        // Get Code problem checkbox value 

        var Code_problem_value = document.getElementById("Code_for_problem_input_widget"); 
        
        var Code_problem_main_value ; 

        if(Code_problem_value.checked == true){

            Code_problem_main_value = 1 ;     

        }

        else{

            Code_problem_main_value = 0 ; 

        }

        // Get searching words value 

        var Get_searching_words = document.getElementById("Keywords_input").value ; 

        if( Code_title == ""){
            document.getElementsByClassName("Send_code_division_error_message")[0].innerText = " ! Please, Enter code title" ; 
            document.getElementsByClassName("Send_code_division_error_message")[1].innerText = "" ; 
            document.getElementsByClassName("Send_code_division_error_message")[2].innerText = "" ; 
            document.getElementsByClassName("Send_code_division_error_message")[3].innerText = "" ; 
        }

        else if (Code_language == ""){
            document.getElementsByClassName("Send_code_division_error_message")[0].innerText = "" ; 
            document.getElementsByClassName("Send_code_division_error_message")[1].innerText = " ! Please, Select your code language " ; 
            document.getElementsByClassName("Send_code_division_error_message")[2].innerText = "" ; 
            document.getElementsByClassName("Send_code_division_error_message")[3].innerText = "" ; 
        }

        else if ( Main_code == "" ){
            document.getElementsByClassName("Send_code_division_error_message")[0].innerText = "" ; 
            document.getElementsByClassName("Send_code_division_error_message")[1].innerText = "" ; 
            document.getElementsByClassName("Send_code_division_error_message")[2].innerText = " ! Please, Enter your programme code " ; 
            document.getElementsByClassName("Send_code_division_error_message")[3].innerText = "" ; 
        }

        else if ( Get_searching_words == ""){
            document.getElementsByClassName("Send_code_division_error_message")[0].innerText = "" ; 
            document.getElementsByClassName("Send_code_division_error_message")[1].innerText = "" ; 
            document.getElementsByClassName("Send_code_division_error_message")[2].innerText = "" ; 
            document.getElementsByClassName("Send_code_division_error_message")[3].innerText = " ! Please, Your code searching words separate with comma " ; 
        }

        else{

            $("#Send_code_button").css("display","none") ; 

            $(".Spinner_division").css("display", "flex") ; 

            $.post("Send_code.php", {Send_code_title:Code_title , Send_code_language:Code_language , Send_code:Main_code , Send_code_searching_word : Get_searching_words , 
            Send_code_problem_value:Code_problem_main_value}, function(data){
                
                console.log(Code_title) ; 
                console.log(Code_language) ; 
                console.log(Main_code) ; 
                console.log(Code_problem_main_value); 
                
                if(data == "Done"){

                    $(".Spinner_division").css("display", "none") ;

                    $("#Send_code_button").css("display", "block") ; 

                    $("#Send_code_background_division").css("display","none") ; 

                    // Set all input fields value to NULL 

                    document.getElementById("Code_title_input").value = "" ; 

                    document.getElementById("Code_language_select").value = "" ; 

                    document.getElementById("Code_textarea").value = "" ; 

                    document.getElementById("Keywords_input").value = "" ; 

                    document.getElementById("Notification_message_division").style.display = "block" ; 

                    document.getElementById("Notification_message_division").innerText = "Code upload successfully" ; 

                    setTimeout(function(){
                        $("#Notification_message_division").css("display","none") ; 
                    }, 3000) ; 

                }

                else{
                    $(".Spinner_division").css("display","none") ; 
                    $("#Send_code_button").css("display","block") ; 
                    alert("There some error related to uploading code on server") ; 
                }
            }) ; 
        }
    }) ; 

}) ; 


// Function which set account setting division

function Set_account_setting_division(){
    
    $("#Account_setting_background_division").css("display","block") ; 
}


// Function which disable account setting division

function Disable_account_setting_division(){

    $("#Account_setting_background_division").css("display","none") ; 
}


// Function which set update email address division 

function Set_update_email_division(){
    document.getElementsByClassName("Update_data_error_message_division")[0].innertText = "" ; 
    $("#Update_emailaddress_background_division").css("display", "block") ; 
}

// Function which disable update email address division 

function Disable_update_email_division(){
    $("#Update_emailaddress_background_division").css("display","none") ; 
}

// Function which set verification code for update email // 

function Set_verification_code_function(){

    // Get email address input value 

    var Update_email_value = document.getElementById("Update_email_input").value ; 
  
    if(Update_email_value == ""){
        document.getElementsByClassName("Update_data_error_message_division")[0].innerText = "Please, Enter email address" ; 
    }

    else{

        $.post("Update_email.php", {Update_email:Update_email_value}, function(data){

            if(data == "Find"){
                document.getElementsByClassName("Update_data_error_message_division")[0].innerText = " ! This email address already taken" ; 
            }
            else{
                document.getElementById("Update_data_error_message_division")[0].innertText = "" ; 
                $("#Update_emailaddress_background_division").css("display", "none") ; 
                $("#Update_email_verify_background_division").css("display","block") ; 
            }
        });
    }
}

// Function which close email verification code division 

function Disable_email_verification_code_division(){
    $("#Update_email_verify_background_division").css("display","none") ; 
}

// Function which update email in Database // 

function Update_email_database_function(){

    // Get verification code input value 

    var Verification_code_value = document.getElementById("Update_email_code").value ; 

    if(Verification_code_value == ""){
        document.getElementsByClassName("Update_data_error_message_division")[1].innerText = " ! Please, Enter verificattion code" ; 
    }

    else{

        $.post("Update_email_verify.php", {Email_verification_code:Verification_code_value}, function(data){
            if(data == "Invaild"){
                document.getElementsByClassName("Update_data_error_message_division")[1].innerText = " ! Invaild verification code " ; 
            }

            else if (data == "Find"){
                document.getElementsByClassName("Update_data_error_message_division")[1].innerText = " This email address already taken " ;
            }

            else{
                document.getElementById("Update_data_error_message_division")[1].innertText = "" ; 
                $("#Update_email_verify_background_division").css("display","none") ; 
                $("#Account_setting_division").load('codestyle'+" #Account_setting_division>*","");

            }
        });
    }
}

// Function which set update instragram username division 

function Set_instagram_username_division(){
    document.getElementsByClassName("Update_data_error_message_division")[2].innertText = "" ; 
    $("#Update_instagram_username_division").css("display", "block") ; 
}

// Function which disable instagram username division 

function Disable_instagram_username_division(){
    $("#Update_instagram_username_division").css("display","none") ; 
}

// Function which set instagram username in database 

function Set_instagram_username_function(){

    // Instagram username 

    var I_username = document.getElementById("Instagram_username_value").value ; 

    if ( I_username == ""){
        document.getElementsByClassName("Update_data_error_message_division")[2].innerText = " ! Please, Enter Instagram username" ; 

    }

    else{

        $.post("Update_instagram.php", {insta_username:I_username}, function(data){
            
            if(data == "Update"){
                document.getElementById("Update_data_error_message_division")[2].innerText = "" ; 
                $("#Update_instagram_username_division").css("display", "none") ;
                $("#Account_setting_division").load('codestyle.php'+" #Account_setting_division>*","");
 
            }

            else{
                alert("Getting error for update Instagram username") ; 
            }
        }) ; 
    }
}

// Function which set Twitter username division 

function Set_twitter_username_division(){
    document.getElementsByClassName("Update_data_error_message_division")[3].innertText = "" ; 
    $("#Update_twitter_username_division").css("display", "block") ; 
}

// Function which disable Twitter username division 

function Disable_twitter_username_division(){
    $("#Update_twitter_username_division").css("display", "none") ; 
}

// Function which update twitter username in database 

function Update_twitter_username_in_database(){

    // Get twitter username value 

    var Twitter_username = document.getElementById("Twitter_username").value ; 

    if(Twitter_username == ""){
        document.getElementsByClassName("Update_data_error_message_division")[3].innerText = " ! Please, Enter Twitter username" ; 
    }

    else{

        $.post("Update_twitter.php", {twitter_username:Twitter_username}, function(data){
            if(data == "Update"){
                document.getElementById("Update_data_error_message_division")[3].innertText = "" ; 
                $("#Update_twitter_username_division").css("display","none") ; 
                $("#Account_setting_division").load('codestyle.php'+" #Account_setting_division>*","");
            }

            else{
                alert("Getting error for update Twitter username")
            }
        });
    }
}

// Function which set website url division 

function Set_website_url_division(){
    document.getElementsByClassName("Update_data_error_message_division")[4].innerText = "" ; 
    $("#Update_weburl_division").css("display","block") ; 
}

// Function which disable website url division 

function Disable_website_url_division(){
    $("#Update_weburl_division").css("display","none") ; 
}

// Function which update website url in database 

function Update_website_url_in_database(){

    // Get website url 

    var Website_url = document.getElementById("Update_website_url").value ; 

    if(Website_url == ""){
        document.getElementsByClassName("Update_data_error_message_division")[4].innerText = "! Please, Enter website url" ; 
    }

    else{

        $.post("Update_websiteurl.php", {url:Website_url}, function(data){
            if(data == "Update"){
                $("#Update_weburl_division").css("display","none") ; 
            }

            else{
                
            }
        })
    }
}

// Function which set account details division 

function Set_account_details_division_function(){

    $("#Account_details_information_background_division").css("display","block") ;

}

// Function which disable account details background division 

function Disbale_account_details_division_function(){
    $("#Account_details_information_background_division").css("display", "none") ; 
}

// Function which set send comment division 

var Send_comment_code_id ; 

var Load_division_i_value ; 

function Set_comment_send_button_division_function(codeid,ivalue){
    
    Send_comment_code_id =  codeid ; 

    Load_division_i_value = ivalue ; 

    $("#Send_comment_background_division").css("display","block") ; 
}

// Function which close send comment division

function Close_comment_send_button_division_function(){

    $("#Send_comment_background_division").css("display","none") ; 

}

// Function for send comment main division 

function Send_comment_function(){

    // Comment value 

    var Comment_message = document.getElementById("Send_comment_textarea").value ; 

    if (Comment_message == ""){
        document.getElementById("Comment_division_error_message").innerText = " Please, Enter comment message" ; 
    }

    else{

        $.post("Send_comment.php", {comment_code_id:Send_comment_code_id, comment_message:Comment_message}, function(data){
            if(data == "sendcomment"){
                
                document.getElementById("Send_comment_textarea").value = ""  ; 
                $("#Send_comment_background_division").css("display","none") ; 

                location.reload("codestyle.php") ; 

                $("#Notification_message_division").css("display","block") ; 
                document.getElementById("Notification_message_division").innerText = "Comment send successfully " ; 

                setTimeout(function(){
                    $("#Notification_message_division").css("display","none") ;
                },3000) ; 
            }

            else{
                document.getElementById("Send_comment_textarea").value = ""  ; 
            }
        });
    }
}

// Function for like button 

function Do_like_function(ivalue, likevalue, codeid){

    var Codeid = codeid ; 

    var Like_option_value = likevalue ; 

    var Like_image_class_i_value = ivalue ; 

    $.post("Do_like.php", {codeid:Codeid, likevalue:Like_option_value}, function(data){

        if (data == "Activelike"){
            $("#Code_list_main_division").load('codestyle.php'+" #Code_list_main_division>*","");
            $(".Code_main_division").load('codestyle.php'+" .Code_main_division>*","");
        }

        else{
            $("#Code_list_main_division").load('codestyle.php'+" #Code_list_main_division>*","");
            $(".Code_main_division").load('codestyle.php'+" .Code_main_division>*","");

        }
    });

}

// Function which set update password division

function Set_update_password_division(){
    document.getElementsByClassName("Update_data_error_message_division")[5].innertText = "" ; 
    document.getElementsByClassName("Update_data_error_message_division")[6].innertText = "" ; 
    $("#Update_password_division").css("display","block") ; 
}

// Fuction which close update password division

function Close_update_password_division(){
    document.getElementsByClassName("Update_data_error_message_division")[5].innertText = "" ; 
    document.getElementsByClassName("Update_data_error_message_division")[6].innertText = "" ; 
    $("#Update_password_division").css("display","none") ; 
}

function Update_password_function(){

    // Get password value 

    var Password = document.getElementById("Account_update_password").value ; 

    // Get Re-enter password value 

    var Re_enter_password = document.getElementById("Account_re-enter_password").value ; 

    if(Password == ""){
        document.getElementsByClassName("Update_data_error_message_division")[5].innerText = "Please, Enter password " ; 
    }

    else if (Re_enter_password == ""){
        document.getElementsByClassName("Update_data_error_message_division")[6].innerText = "Please, Re-enter password " ;  
    }

    else if ( Password != Re_enter_password){
        document.getElementsByClassName("Update_data_error_message_division")[5].innerText = " Try again , Password didn't match" ; 
    }
    
    else if (Password.length <=8){
        document.getElementsByClassName("Update_data_error_message_division")[5].innerText = "Use 8 or more characters with a mix of letters, numbers & symbols" ; 
    }
    else{
        $.post("Update_password.php", {password_value:Password}, function(data){
            if(data == "Update"){

                document.getElementById("Account_update_password").value = "" ; 
                document.getElementById("Account_re-enter_password").value = "" ; 
               
                $("#Update_password_division").css("display","none") ; 

                $("Notification_message_division").css("display","block") ; 
                document.getElementById("Notification_message_division").innertText = " Password update successfully " ; 

                setTimeout(function(){
                    $("#Notification_message_division").css("display","none") ;
                },3000) ; 
            }
        });
    }
}

// Call search data function 

function Search_data_function(){

    // Get search value 

    var Search_value = document.getElementById("Search_input_widget").value ; 

    if(Search_value == ""){
        alert("Please, Enter search value") ; 
    }

    else{

        $.post("Search_data.php", {searchvalue:Search_value}, function(data){
            
            if(data == "Find"){
                document.getElementById("Search_input_widget").value = "" ; 
                $("#Code_list_main_division").css("display","block") ; 
                $("#All_code_list_division").css("display","none") ; 
                $("#Code_list_main_division").load('codestyle.php'+" #Code_list_main_division>*","");
            }

            else{
                alert("Not find any data") ; 
            }
        }) ;
    }
}

// Function which set code owner data 

function Set_code_owner_data_function(like_count_value,ownername){

    var Likecount = like_count_value ; 

    var ownername_information = ownername ; 

    $.post("Fetch_code_owner_data.php", {owner_username:ownername_information , count:Likecount}, function(data){
        if(data == "Set "){
            $("#Code_owner_information_division").css("display", "block") ; 
            $("#Code_owner_information_division").load('codestyle'+" #Code_owner_information_division>*","");
        }

        else{}
    });
}

// Function which close set code owner division 

function Close_code_owner_data_division_function(){
    $("#Code_owner_information_division").css("display","none") ;
}

// Function which fetcch all comment data 

function Fetch_all_commentdata_function(comment_codeid,Code_title){

    var Comment_code_codeid = comment_codeid ; 
    
    var Comment_code_title = Code_title ; 

    $.post("Fetch_comment_data.php", {id:Comment_code_codeid,title:Comment_code_title}, function(data){
        
        if(data == "Setdata"){

            $("#Show_all_comment_background_division").css("display","block") ; 
            $("#All_comment_data_division").load('codestyle'+" #All_comment_data_division>*","");
        }
    }) ; 
}

// Function which close all comment data division 

function Close_all_commentdata_division_function(){
    $("#Show_all_comment_background_division").css("display","none") ; 
}

function Set_code_list_option_function(){

    $("#Code_list_main_division").css("display","none") ; 

    $.post("Fetch_code_list.php",function(data){

        $("#All_code_list_division").css("display","block") ;
        $("#All_code_list_division").load('codestyle'+" #All_code_list_division>*","");
 
    });
}