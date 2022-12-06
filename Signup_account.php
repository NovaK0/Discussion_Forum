<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Signup_account.css">
    <link rel="shortcut icon" href="./Logo/Website-logo.png" type="image/x-icon">
    <title>Verify email</title>

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

        <div class="Signup_account_division">
                 
            <div class="Signup_account__title">
                Verify email address
            </div>
            
            <!-- Verification code taken input  -->
          
            <input type="text" name="" id="Verification-code" placeholder="Enter verification code">
            
            <div id="Error_message_division">
            </div>
            
            <!-- Signup button  -->
            <button id="Signup_button">Signup</button>

        </div>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="Signup_account.js"></script>
</body>
</html>