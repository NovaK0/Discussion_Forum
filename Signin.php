<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signin</title>
    <link rel="stylesheet" href="Signin.css">
    <link rel="shortcut icon" href="./Logo/Website-logo.png" type="image/x-icon">
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

        <div class="Signin_container">

            <div id="Signin_container__title__userimage">
                 
                <div id="Signin_container__userimage">
                    <img src="./Images/User_icon.ico" alt="" id="Userimage">
                </div>
                 
                <div id="Signin_container__title">
                    Signin
                </div>

            </div> 

            <div id="Data_form">

                <input type="text" id="Username" placeholder="Enter username">
 
                <div class="Error_message_division"></div>

                <input type="password"id="Password" placeholder="Enter password">

                <div class="Error_message_division"></div>

            </div>

            <button id="Submit_data_button">Submit</button>

        </div>

    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="Signin.js"></script>

</body>
</html>