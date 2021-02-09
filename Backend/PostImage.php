<?php
require_once("ConnectDB.php");

class PostImage{
    private $id;
    private $postID;
    private $location;

    function __construct(){
        $this->db = ConnectDB::connect(); 
        $this->connectDB = new ConnectDB();
    }

    public function initPostImage($imageID,$postID,$location){
        $this->setID($imageID);
        $this->setPostID($postID);
        $this->setLocation($location);
    }

    public function insertPostImage():bool{
        $query = <<<SQL
        INSERT INTO post_image (postID,image_location)
        VALUES (:val1,:val2)
        SQL;

        $statement = $this->db->prepare($query);
        $statement->bindValue('val1', $this->getPostID());
        $statement->bindValue('val2', $this->getLocation());
        $res = $this->connectDB->execute($statement);
        
        if($res)
            return true;
        elseif(!$res)
            return false;
    }

    public function selectPostImage($field,$value):array{
        $query = <<<SQL
        SELECT * FROM post_image
        WHERE $field = :val1
        SQL;

        $statement = $this->db->prepare($query);
        $statement->bindValue('val1',$value);

        $this->connectDB->execute($statement);
        $numRows = $this->connectDB->getNumRows();
        $rows = $this->connectDB->getRows();

        $images = array();
        if($numRows >= 1){
            foreach($rows as $row){
                $location = $row['image_location'];
                array_push($images,$location);
            }
        }
        return $images;
    }

    public function removePostImage($fieldName,$value):bool{
        $query = <<<SQL
        DELETE FROM post_image
        WHERE $fieldName = :val1
        SQL;

        $statement = $this->db->prepare($query);
        $statement->bindValue('val1', $value);
        
        if($this->connectDB->execute($statement))
            return true;
        elseif(!$this->connectDB->execute($statement))
            return false;
    }

    public function setID($id){
        $this->id = $id;
    }

    public function getID(){
        return $this->id;
    }

    public function setPostID($postID){
        $this->postID = $postID;
    }

    public function getPostID(){
        return $this->postID;
    }

    public function setLocation($location){
        $this->location = $location;
    }

    public function getLocation(){
        return $this->location;
    }

    public function uploadImage():void{
        $imagePath = "";
        $temp = $_FILES['image']['tmp_name'];

        $new_name = md5(rand().time()).'.jpg';
        move_uploaded_file($temp, "../uploads/adImages/".$new_name);

        $path_parts = pathinfo($_FILES['image']["name"]);
        $ext = $path_parts['extension'];

        if(strcasecmp($ext,"png")==0 || strcasecmp($ext,"jpg")==0 || strcasecmp($ext,"ico")==0 || strcasecmp($ext,"bmp")==0){
            //file location
            $imagePath = "http://127.0.0.1/khangisa2/uploads/adImages/$new_name";   
        }

        $this->setLocation($imagePath);
    }
}

?>