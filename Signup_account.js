$(document).ready(function(){
    $("#Signup_button").click(function(event){

        event.preventDefault() ; 

        // Get varification code value // 

        var code = document.getElementById("Verification-code").value ; 

        // Get error message division // 

        var Error_message_division = document.getElementById("Error_message_division") ; 

        if(code == ""){

            Error_message_division.innerText = " ! Please, Enter verification code " ; 

        }

        else{
            
            $.post("Signup_data_send.php", {verifycode:code}, function(data){
                
                console.log(data) ; 
                
                if (data == "Not match"){
                    Error_message_division.innerText = " ! Invaild verification code" ; 
                }

                else{
                    
                    window.location.href = "codestyle.php" ; 
                }
            });
        }
    });
})
