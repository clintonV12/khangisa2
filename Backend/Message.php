<?php 
require_once("ConnectDB.php");

class Message {
    private $messageID;
    private $sender;
    private $receipient;
    private $content;
    private $db = null;
    private $connectDB = null;

    function __construct(){
        $this->db = ConnectDB::connect(); 
        $this->connectDB = new ConnectDB();
    }

    public function initMessage($messageID,$sender,$receipient,$content){
        $this->setSender($sender);
        $this->setReceipient($receipient);
        $this->setContent($content);
        $this->setMessageID($messageID);
    }

    public function insertMessage():int{
        $query = <<<SQL
        INSERT INTO messages (senderID,receipientID,content)
        VALUES (:val1,:val2,:val3)
        SQL;

        $statement = $this->db->prepare($query);
        $statement->bindValue('val1', $this->getSender());
        $statement->bindValue('val2', $this->getReceipient());
        $statement->bindValue('val3', $this->getContent());
        $res = $this->connectDB->execute($statement);
        
        if($res)
            return $this->db->lastInsertId();
        elseif(!$res)
            return 0;
    }

    public function selectMessage($field,$value):Message{
        $query = <<<SQL
        SELECT * FROM messages
        WHERE $field = :val1
        SQL;

        $statement = $this->db->prepare($query);
        $statement->bindValue('val1',$value);

        $this->connectDB->execute($statement);
        $numRows = $this->connectDB->getNumRows();
        $rows = $this->connectDB->getRows();

        $message = new Message();
        if($numRows >= 1){
            foreach($rows as $row){
                $messageID = $row['messageID'];
                $sender = $row['senderID'];
                $receipient = $row['receipientID'];
                $content = $row['content'];
                

                $message->initMessage($messageID,$sender,$receipient,$content);        
            }
        }
        return $message;
    }

    public function selectAllMessages($field,$value):array{
        $query = <<<SQL
        SELECT * FROM messages
        WHERE $field = :val1
        ORDER BY messageID DESC
        SQL;

        $statement = $this->db->prepare($query);
        $statement->bindValue('val1',$value);

        $this->connectDB->execute($statement);
        $numRows = $this->connectDB->getNumRows();
        $rows = $this->connectDB->getRows();

        $messages = array();
        if($numRows >= 1){
            foreach($rows as $row){
                $messageID = $row['messageID'];
                $sender = $row['senderID'];
                $receipient = $row['receipientID'];
                $content = $row['content'];        
                
                $message = new Message();
                $message->initMessage($messageID,$sender,$receipient,$content);  
                array_push($messages,$message);     
            }
        }
        return $messages;
    }

    public function updateMessage($whereField,$whereValue,$updateField,$updateValue):bool{
        $query = <<<SQL
        UPDATE messages
        SET $updateField = :val1
        WHERE $whereField = :val2
        SQL;  

        $statement = $this->db->prepare($query);
        $statement->bindValue('val1', $updateValue);
        $statement->bindValue('val2', $whereValue);

        if($this->connectDB->execute($statement))
            return true;
        elseif(!$this->connectDB->execute($statement))
            return false;
    }

    public function removeMessage($fieldName,$value):bool{
        $query = <<<SQL
        DELETE FROM messages
        WHERE $fieldName = :val1
        SQL;

        $statement = $this->db->prepare($query);
        $statement->bindValue('val1', $value);
        
        if($this->connectDB->execute($statement))
            return true;
        elseif(!$this->connectDB->execute($statement))
            return false;
    }

    public function setMessageID($messageID){
        $this->messageID = $messageID;
    }

    public function getMessageID(){
        return $this->messageID;
    }

    public function setSender($sender){
        $this->sender = $sender;
    }

    public function getSender(){
        return $this->sender;
    }

    public function setReceipient($receipient){
        $this->receipient = $receipient;
    }

    public function getReceipient(){
        return $this->receipient;
    }

    public function setContent($content){
        $this->content = $content;
    }

    public function getContent(){
        return $this->content;
    }
}

?>