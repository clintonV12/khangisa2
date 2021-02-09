<?php
session_start();
require_once("Message.php");
require_once("Post.php");
require_once("User.php");

@ $accountInfo = $_POST['accountInfo'];
//update profile
@ $name = $_POST['name'];
@ $surname = $_POST['surname'];
@ $email = $_POST['email'];
@ $phone = $_POST['phone'];
@ $imageAvail = $_POST['imageAvail'];

//update password
@ $currentPassword = $_POST['currentPassword'];
@ $newPassword = $_POST['newPassword'];

$response = array();
$userID = $_SESSION['userID'];



if(isset($accountInfo) && !empty($accountInfo)){
    $msg = new Message(); 
    $messages = $msg->selectAllMessages("receipientID",$userID);
    $mCount = 0;
    foreach($messages as $message){ $mCount += 1; }

    $post = new Post(); 
    $posts = $post->selectAllUserPosts($userID);
    $pCount = 0;
    foreach($posts as $p){ $pCount += 1; }

    $user = new User();
    $u = $user->selectUser("userID",$userID);

    array_push($response,array("name"=>$u->getName(),"surname"=>$u->getSurname(),"email"=>$u->getEmail(),"phone"=>$u->getPhone(),"image"=>$u->getImage(),"numPost"=>$pCount,"numMsg"=>$mCount));
    echo json_encode($response);
}elseif( isset($name) && !empty($name)){
    $user = new User();
    $res = $user->updateUser("userID",$userID,"name",$name);
    $res = $user->updateUser("userID",$userID,"surname",$surname);
    $res = $user->updateUser("userID",$userID,"email",$email);
    $res = $user->updateUser("userID",$userID,"phone",$phone);
    if($imageAvail == '1'){
        $user->uploadImage();
        if($user->getImage() != null || $user->getImage() != ""){
            //delete ad image file
            $u = $user->selectUser("userID",$userID);
            $img = $u->getImage();

            $imgArray = preg_split("{/}",$img,NULL,NULL);
            $size = sizeof($imgArray);
            $imageName = $imgArray[$size-1];
            @ unlink('../uploads/profile_pics/'.$imageName);
            $res = $user->updateUser("userID",$userID,"image",$user->getImage());
        }
    }

    if($res){
        array_push($response,array("Result"=>"successfuly"));
        echo json_encode($response);
    }elseif(!$res){
        array_push($response,array("Result"=>"not successfuly"));
        echo json_encode($response);
    }
}elseif(isset($currentPassword) && !empty($currentPassword)){
    $user = new User();
    $user->setPassword($currentPassword);

    if($user->selectUserPassword("userID",$userID) === $user->getPassword()){
        $user->setPassword($newPassword);
        $res = $user->updateUser("userID",$userID,"password",$user->getPassword());

        if($res){
            array_push($response,array("Result"=>"successfuly"));
            echo json_encode($response);
        }elseif(!$res){
            array_push($response,array("Result"=>"not successfuly"));
            echo json_encode($response);
        }
    }else{
        array_push($response,array("Result"=>"not successfuly"));
        echo json_encode($response);
    }
}

?>