<?php
session_start();

if(!isset($_SESSION['userID'])){
    header("location: signin.php");
    exit();
}else{
    $_SESSION = array(); // Destroy the variables
    $params = session_get_cookie_params();
    
    if (session_status() == PHP_SESSION_ACTIVE) {session_destroy(); }
    header("location: index.php");
}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>Buciko</title>
        <!-- site icons -->
        <link rel="icon" href="images/fevicon/fevicon.png" type="image/gif" />
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        
    </head>
    <body>
        <h1 style="text-align: center; font-size: xx-large;">Thank you for using Buciko</h1>
           
        <script type="text/javascript" src="js/custom/signout.js"></script>
        <script>
            setTimeout(function(){sendLogoutRequest()},3000);
        </script> 
        <script type="text/javascript" src="js/custom/ajaxFunctions.js"></script>
    </body>
</html>

