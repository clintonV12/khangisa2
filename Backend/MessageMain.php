<?php
session_start();
require_once("Message.php");
require_once("User.php");

@ $receipentID = $_POST['receipent'];
@ $content = $_POST['content'];
@ $allMyMsg = $_POST['allMyMsg'];

//delete message
@ $messageID = $_POST['messageID'];

//message reply
@ $replyMsg = $_POST['replyMsg'];
@ $replyReceiver = $_POST['replyReceiver'];

$response = array();
@ $userID = $_SESSION['userID'];

if(isset($receipentID) && !empty($receipentID)){
    
    if($userID == null){
        array_push($response,array("Result"=>"not sent.\nYou must be logged in to be able to send messages."));
        echo json_encode($response);
    }else{
        $msg = new Message();
        $msg->setContent($content);
        $msg->setReceipient($receipentID);
        $msg->setSender($userID);
        
        $res = $msg->insertMessage();

        if($res){
            array_push($response,array("Result"=>"successfuly sent."));
            echo json_encode($response);
        }elseif(!$res){
            array_push($response,array("Result"=>"not successfuly sent."));
            echo json_encode($response);
        }
    }
}elseif(isset($allMyMsg) && !empty($allMyMsg)){
    $msg = new Message(); 
    $messages = $msg->selectAllMessages("receipientID",$userID);
    
    foreach($messages as $message){ 
        $sender = new User();
        $u = $sender->selectUser("userID",$message->getSender());
        array_push($response, array("senderID"=>$u->getUserID(),"name"=>$u->getName(),"surname"=>$u->getSurname(),"email"=>$u->getEmail(),"phone"=>$u->getPhone(),"messageID"=>$message->getMessageID(),"content"=>$message->getContent()));
     }
     echo json_encode($response);
}elseif(isset($messageID) && !empty($messageID)){
    $message = new Message();
    $res = $message->removeMessage("messageID",$messageID);

    if($res){
        array_push($response,array("Result"=>"successfuly"));
        echo json_encode($response);
    }elseif(!$res){
        array_push($response,array("Result"=>"not successfuly"));
        echo json_encode($response);
    }
}elseif(isset($replyReceiver) && !empty($replyReceiver)){
    if($userID == null){
        array_push($response,array("Result"=>"not sent.\nYou must be logged in to be able to send messages."));
        echo json_encode($response);
    }else{
        $msg = new Message();
        $msg->setContent($replyMsg);
        $msg->setReceipient($replyReceiver);
        $msg->setSender($userID);
        
        $res = $msg->insertMessage();

        if($res){
            array_push($response,array("Result"=>"successfuly sent."));
            echo json_encode($response);
        }elseif(!$res){
            array_push($response,array("Result"=>"not successfuly sent."));
            echo json_encode($response);
        }
    }
}
?>