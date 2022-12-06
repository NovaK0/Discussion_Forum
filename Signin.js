$(document).ready(function(){

    $("#Submit_data_button").click(function(event){

    event.preventDefault() ; 

    // Get Username value 

    var Username = document.getElementById("Username").value  ; 
    var Password = document.getElementById("Password").value ;

    if(Username == ""){
        document.getElementsByClassName("Error_message_division")[0].innerText = " ! Please, Enter username" ;
        document.getElementsByClassName("Error_message_division")[1].innerText = "" ;
    }

    else if(Password == ""){
        document.getElementsByClassName("Error_message_division")[0].innerText = "";
        document.getElementsByClassName("Error_message_division")[1].innerText = " ! Please, Enter password";
    }

    else{

        $.post("Signin_check.php", {Username_value:Username , Password_value:Password}, function(data){
            console.log(data) ; 
            if(data == "Notfind"){

                document.getElementsByClassName("Error_message_division")[0].innerText = " ! Not find this username" ; 
                document.getElementsByClassName("Error_message_division")[1].innerText = "" ; 
            }
            
            else if (data == "Invaildpassword"){

                document.getElementsByClassName("Error_message_division")[0].innerText = "" ;
                document.getElementsByClassName("Error_message_division")[1].innerText = " ! Invaild password "; 
            }

            else{}
        });
    }

    });

});

