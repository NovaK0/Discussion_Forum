$(document).ready(function(){
    $("#Submit_data_button").click(function(event){

        event.preventDefault() ; 
        
        // Username value 

        var Username = document.getElementById("Username").value ; 

        // Email address value 

        var Email_address = document.getElementById("Emailaddress").value ;

        // Password value 

        var Password = document.getElementById("Password").value ; 

        var Password_length = Password.length ; 

        // Re-enter password value 

        var Re_enter_password = document.getElementById("Repeat-password").value ; 

        // Username error message divisison 

        var Username_error_division = document.getElementsByClassName("Error_message_division")[0] ; 

        // Emailaddress message division 

        var Emailaddress_error_division = document.getElementsByClassName("Error_message_division")[1] ; 

        // Password error message division 

        var Password_error_division = document.getElementsByClassName("Error_message_division")[2] ; 

        // Re-enter password error message division 

        var Re_password_error_division = document.getElementsByClassName("Error_message_division")[3] ; 

        if(Username == ""){
            Username_error_division.innerText = "! Please, Enter username" ; 
            Emailaddress_error_division.innerText = "" ; 
            Password_error_division.innerText = "" ; 
            Re_password_error_division.innerText = "" ; 
        }

        else if (Email_address == ""){
            Emailaddress_error_division.innerText = "! Please, Enter email address" ;
            Username_error_division.innerText = "" ; 
            Password_error_division.innerText = "" ; 
            Re_password_error_division.innerText = "" ; 
        }

        else if (Password == ""){
            Password_error_division.innerText = " ! Please , Enter password" ; 
            Username_error_division.innerText = "" ; 
            Emailaddress_error_division.innerText = "" ; 
            Re_password_error_division.innerText = "" ; 
        }

        else if ( Re_enter_password == ""){
            Username_error_division.innerText = "" ; 
            Emailaddress_error_division.innerText = "" ; 
            Password_error_division.innerText = "" ; 
            Re_password_error_division.innerText = " ! Please, Re-enter password " ; 
        }

        else if (Password_length <= 8){
            Username_error_division.innerText = "" ; 
            Emailaddress_error_division.innerText = "" ; 
            Re_password_error_division.innerText = "" ;
            Password_error_division.innerText = "Use 8 or more characters with a mix of letters, numbers & symbols";
        }
        
        else if (Password != Re_enter_password){
            Username_error_division.innerText = "" ; 
            Emailaddress_error_division.innerText = "" ; 
            Password_error_division.innerText = " ! Password does not match try again " ; 
            Re_password_error_division.innerText = "" ;
        }

        else{
              
            $.post("Signup_data_check.php", {database_username:Username,database_emailaddress:Email_address , database_password:Password} , function(data){

                if(data == "Findemail"){
                    Username_error_division.innerText = "" ; 
                    Emailaddress_error_division.innerText = "This email address already taken" ; 
                }
                
                else if (data == "Findusername"){
                    Emailaddress_error_division.innerText = "" ; 
                    Username_error_division.innerText = " This username already taken " ; 
                }

                else if (data == "username-email"){
                    Username_error_division.innerText = " This username already taken " ; 
                    Emailaddress_error_division.innerText = " This email address already taken" ; 
                }

                else{
                    window.location = "./Signup_account.php" ; 
                }
            });
        }

    }) ;
}) ; 
