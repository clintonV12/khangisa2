<!DOCTYPE html>
<html lang="en">
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
        <style>
          html{
            margin: 0;
            padding: 0;
            background: url('images/it_service/home_01.jpg') no-repeat center center fixed;
            background-size: cover;
            background-position: center;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            font-family: sans-serif;
          }

          .loginbox{
            width: 320px;
            height: 480px;
            background: #17a5e9;
            color: #fff;
            top: 50%;
            left: 50%;
            position: absolute;
            transform: translate(-50%,-50%);
            box-sizing: border-box;
            padding: 70px 30px;
            border-radius: 15px;
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2); 
            transition: 0.3s;
          }

          .avatar{
            width: 100px;
            height: 100px;
            border-radius: 50%;
            position: absolute;
            top: -50px;
            left: calc(50% - 50px);
          }

          .loginbox h1{
            margin: 0;
            padding: 0 0 20px;
            text-align: center;
            font-size: 22px;
          }

          .loginbox p{
            margin: 0;
            padding: 0;
            font-weight: bold;
          }

          .loginbox input{
            width: 100%;
            margin-bottom: 20px;
          }

          .loginbox input[type="number"], input[type="password"]{
            border: none;
            border-bottom: 1px solid #fff;
            background: transparent;
            outline: none;
            height: 40px;
            color: #fff;
            font-size: 16px;
          }

          .loginbox input[type="submit"]{
            border: none;
            outline: none;
            height: 40px;
            background: #fff;
            color: #000;
            font-size: 18px;
            border-radius: 20px;
          }

          .loginbox input[type="submit"]:hover{
            cursor: pointer;
            background: #000;
            color: #fff;
          }

          .loginbox a{
            text-decoration: none;
            font-size: 12px;
            line-height: 20px;
            color: #fff;
          }

          .loginbox a:hover{
            color: #ff4500;
            font-weight: bold;
          }

        </style>
    </head>

    <body>
      <div class="loginbox">
        <img src="images/loaders/loader_1.png" class="avatar">
        <h1>Buciko Password Recovery</h1>
        <p><small>Enter Your Phone Number And Instructions Will Be Emailed To You.</small></p><br><br>
        <form method="post" action="recover_password.php">
          <p>Phone number</p>
          <input type="number" name="phone" placeholder="Enter phone number">
          <input type="submit" value="Reset">
          <a href="signin.php">Return To Login Page</a>
        </form>
      </div>

    <?php
        require_once("Backend/User.php");
        @ $phone = $_POST['phone'];

        $user = new User();
        $u = $user->selectUser("phone",$phone);

        $new_password = rand(100000,100000000);
        $user->setPassword($new_password);
        $user->updateUser("phone",$phone,"password",$user->getPassword());

        $email = "info@buciko.com";

        if(isset($message) && !empty($message)){
            $to = $u->getEmail();
            $subject = "Password Recovery";
            $message = "<h1>Hi:".$u->getName()."</h1><br><p>Your new passowrd is: <b>".$new_password."</b></p><br><a href='www.buciko.com/signin.php'>Click here to login</a>";
            $header = "From:".$email."\r\n";
            $header .= "MIME-Version: 1.0\r\n";
            $header .= "Content-type: text/html\r\n";
            $retval = mail ($to,$subject,$message,$header);

            if( $retval == true )
            {
                echo "<script type='text/javascript'> alert('Message sent successfully...')</script>";
            }else{
                echo "<script type='text/javascript'> alert('Message could not be sent...')</script>";
            }
        }
    ?>
    
    <script type="text/javascript" src="js/custom/ajaxFunctions.js"></script>
    <script src="js/custom/signin.js"></script>
    </body>
</html>