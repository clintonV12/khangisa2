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

          .loginbox input[type="button"]{
            border: none;
            outline: none;
            height: 40px;
            background: #fff;
            color: #000;
            font-size: 18px;
            border-radius: 20px;
          }

          .loginbox input[type="button"]:hover{
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
        <h1>Buciko Login</h1>
        <form>
          <p>Phone number</p>
          <input type="number" id="username" placeholder="Enter phone number">
          <p>Password</p>
          <input type="password" id="password" placeholder="Enter password">
          <input type="button" value="Login" onclick="sendLogin()">
          <a href="recover_password.php">Forgot password?</a><br>
          <a href="signup.php">Don't have account?</a><br>
          <a href="posts.php">Continue without login.</a>
        </form>
      </div>
    
    <script type="text/javascript" src="js/custom/ajaxFunctions.js"></script>
    <script src="js/custom/signin.js"></script>
    </body>
</html>