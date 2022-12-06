<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Signup</title>
    
    <link rel="shortcut icon" href="./Logo/Website-logo.png" type="image/x-icon">
    <link rel="stylesheet" href="Signup.css">
   
    <!-- Title font family -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300&display=swap" rel="stylesheet">
    
    <!-- Other font family  -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Mukta&display=swap" rel="stylesheet">

</head>
<body>
    <div class="Container">

        <div class="Logo_container">
            <img src="./Logo/Website-logo.png" alt="" class="Logo_image">
            <div class="Logo_name">
               Codestyle
            </div>
        </div>

        <div class="Signup_container">
            
            <div id="Signup_container__title__userimage">
                 
                <div id="Signup_container__userimage">
                    <img src="./Images/User_icon.ico" alt="" id="Userimage">
                </div>
                
                <div id="Signup_container__title">
                    Signup
                </div>

            </div>


            <form action="#" id="Data_form">
              
               <input type="text" name="" id="Username" placeholder="Enter username"><br>
               
               <!-- Username error message division  -->

               <div class="Error_message_division" id="Username_error"></div>

               <input type="email" name="" id="Emailaddress" placeholder="Enter emailaddress" ><br>
               
               <!-- Email address message division  -->

               <div class="Error_message_division"></div>

               <input type="password" name="" id="Password" placeholder="Enter password"><br>
               
               <!-- Password message division  -->

               <div class="Error_message_division"></div>

               <input type="password" name="" id="Repeat-password" placeholder="Re-enter password"><br>
               
               <!-- Re-enter password message division  -->

               <div class="Error_message_division"></div>

               <!-- Submit data button  -->

               <button id="Submit_data_button">Submit</button>
               
            </form>

        </div>

    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="Signup_js.js"></script>

</body>
</html>