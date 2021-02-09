<?php
session_start();
require_once("User.php");

@ $signupInfo = $_POST['signupInfo']; 
@ $name = $_POST['name'];
@ $surname = $_POST['surname'];
@ $email = $_POST['email'];
@ $phone = $_POST['phone'];
@ $city = $_POST['city'];
@ $password = $_POST['pass1'];

$response = array();
@ $userID = $_SESSION['userID'];

if(isset($signupInfo)  && !empty($signupInfo)){
    $user = new User();
    $check = new User();
    $checkUser = $check->selectUser("phone",$phone);
    if($checkUser->getUserID() != null || $checkUser->getUserID() != ""){
        array_push($response,array("Result"=>"same_phone"));
        echo json_encode($response);
    }else{
        $user->setName($name);
        $user->setSurname($surname);
        $user->setEmail($email);
        $user->setPhone($phone);
        $user->setPassword($password);
        $user->uploadImage();

        $res = $user->insertUser();
        if($res){
            array_push($response,array("Result"=>"done"));
            echo json_encode($response);
        }elseif(!$res){
            array_push($response,array("Result"=>"failed"));
            echo json_encode($response);
        }
    }
}

?>