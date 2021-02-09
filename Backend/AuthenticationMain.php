<?php
require_once("Authentication.php");

@ $username = $_POST['username'];
@ $password = $_POST['password'];
@ $logout = $_POST['logout'];

$a = new Authentication();

$loginCorrect = $a->login($username,$password);
$response = array();

if($loginCorrect){  
    session_start();
    $_SESSION['userID'] = $a->getUserID();
    
    array_push($response,array("answer"=>"login successful"));
    echo json_encode($response);
}elseif(!$loginCorrect){
    array_push($response,array("answer"=>"login failed"));
    echo json_encode($response);
}elseif(isset($logout) && !empty($logout)){
    session_unset();
    session_destroy();
}

?>