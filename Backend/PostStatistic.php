<?php

require_once("ConnectDB.php");

class PostStatistic{
    private $postID;
    private $views;
    private $lastViewedOn;
    private $db = null;
    private $connectDB = null;

    function __construct(){
        $this->db = ConnectDB::connect(); 
        $this->connectDB = new ConnectDB();
    }

    public function initPostStatistic($postID,$views,$lastViewedOn){
        $this->setPostID($postID);
        $this->setViews($views);
        $this->setLastViewedOn($lastViewedOn);
    }

    public function insertPostStatistic($postID,$views,$lastViewedOn):int{
        $query = <<<SQL
        INSERT INTO post_statistics (postID,last_viewed_on,views)
        VALUES (:val1,:val2,:val3)
        SQL;

        $statement = $this->db->prepare($query);
        $statement->bindValue('val1', $postID);
        $statement->bindValue('val2', $lastViewedOn);
        $statement->bindValue('val3', $views);
        $res = $this->connectDB->execute($statement);
        
        if($res)
            return $this->db->lastInsertId();
        elseif(!$res)
            return 0;
    }

    public function selectPostStatistic($field,$value):PostStatistic{
        $query = <<<SQL
        SELECT * FROM post_statistics
        WHERE $field = :val1
        SQL;

        $statement = $this->db->prepare($query);
        $statement->bindValue('val1',$value);

        $this->connectDB->execute($statement);
        $numRows = $this->connectDB->getNumRows();
        $rows = $this->connectDB->getRows();

        $postStatistic = new PostStatistic();
        if($numRows >= 1){
            foreach($rows as $row){
                $postID = $row['postID'];
                $lastViewedOn = $row['last_viewed_on'];
                $views = $row['views'];
                
                $postStatistic->initPostStatistic($postID,$views,$lastViewedOn);
            }
        }
        return $postStatistic;
    }

    public function updatePostStatistic($whereField,$whereValue,$updateField,$updateValue):bool{
        $query = <<<SQL
        UPDATE post_statistics
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

    public function removePostStatistic($fieldName,$value):bool{
        $query = <<<SQL
        DELETE FROM post_statistics
        WHERE $fieldName = :val1
        SQL;

        $statement = $this->db->prepare($query);
        $statement->bindValue('val1', $value);
        
        if($this->connectDB->execute($statement))
            return true;
        elseif(!$this->connectDB->execute($statement))
            return false;
    }

    public function setPostID($postID){
        $this->postID = $postID;
    }

    public function getPostID(){
        return $this->postID;
    }

    
    public function setViews($views){
        $this->views = $views;
    }

    public function getViews(){
        return $this->views;
    }

    
    public function setLastViewedOn($lastViewedOn){
        $this->lastViewedOn = $lastViewedOn;
    }

    public function getLastViewedOn(){
        return $this->lastViewedOn;
    }

}

?>