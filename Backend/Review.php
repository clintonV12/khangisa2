<?php
require_once("ConnectDB.php");

class Review{
    private $reviewID;
    private $postID;
    private $reviewSenderID;
    private $reviewText;
    private $reviewDate;
    private $db = null;
    private $connectDB = null;

    function __construct(){
        $this->db = ConnectDB::connect(); 
        $this->connectDB = new ConnectDB();
    }

    public function initReview($reviewID,$postID,$reviewSenderID,$reviewText,$reviewDate){
        $this->setReviewID($reviewID);
        $this->setPostID($postID);
        $this->setReviewSenderID($reviewSenderID);
        $this->setReviewText($reviewText);
        $this->setReviewDate($reviewDate);
    }

    public function addReview($postID,$reviewSenderID,$reviewText,$reviewDate):int{
        $query = <<<SQL
        INSERT INTO reviews (postID,reviewSenderID,reviewText,reviewDate)
        VALUES (:val1,:val2,:val3,:val4)
        SQL;

        $statement = $this->db->prepare($query);
        $statement->bindValue('val1', $postID);
        $statement->bindValue('val2', $reviewSenderID);
        $statement->bindValue('val3', $reviewText);
        $statement->bindValue('val4', $reviewDate);
        $res = $this->connectDB->execute($statement);
        
        if($res)
            return $this->db->lastInsertId();
        elseif(!$res)
            return 0;
    }

    public function selectAllReviews($field,$value):array{
        $query = <<<SQL
        SELECT * FROM reviews
        WHERE $field = :val1
        ORDER BY reviewDate DESC
        SQL;

        $statement = $this->db->prepare($query);
        $statement->bindValue('val1',$value);

        $this->connectDB->execute($statement);
        $numRows = $this->connectDB->getNumRows();
        $rows = $this->connectDB->getRows();

        $reviews = array();
        if($numRows >= 1){
            foreach($rows as $row){
                $reviewID = $row['reviewID'];
                $postID = $row['postID'];
                $reviewSenderID = $row['reviewSenderID'];
                $reviewText = $row['reviewText'];
                $reviewDate = $row['reviewDate'];
                
                $rev = new Review();
                $rev->initReview($reviewID,$postID,$reviewSenderID,$reviewText,$reviewDate);   
                array_push($reviews,$rev);     
            }
        }
        return $reviews;
    }

    public function removeReview($fieldName,$value):bool{
        $query = <<<SQL
        DELETE FROM reviews
        WHERE $fieldName = :val1
        SQL;

        $statement = $this->db->prepare($query);
        $statement->bindValue('val1', $value);
        
        if($this->connectDB->execute($statement))
            return true;
        elseif(!$this->connectDB->execute($statement))
            return false;
    }

    public function setReviewID($reviewID){
        $this->reviewID = $reviewID;
    }

    public function getReviewID(){
        return $this->reviewID;
    }

    public function setPostID($postID){
        $this->postID = $postID;
    }

    public function getPostID(){
        return $this->postID;
    }

    public function setReviewSenderID($reviewSenderID){
        $this->reviewSenderID = $reviewSenderID;
    }

    public function getReviewSenderID(){
        return $this->reviewSenderID;
    }

    public function setReviewText($reviewText){
        $this->reviewText = $reviewText;
    }

    public function getReviewText(){
        return $this->reviewText;
    }

    public function setReviewDate($reviewDate){
        $this->reviewDate = $reviewDate;
    }

    public function getReviewDate(){
        return $this->reviewDate;
    }

}

?>