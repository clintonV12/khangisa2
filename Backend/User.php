<?php
require_once("ConnectDB.php");

class User {
    private $userID;
    private $image;
    private $name;
    private $surname;
    private $email;
    private $phone;
    private $password;
    private $db = null;
    private $connectDB = null;

    function __construct(){
        $this->db = ConnectDB::connect(); 
        $this->connectDB = new ConnectDB();
    }

    public function initUser($userID,$name,$surname,$email,$phone,$password,$image){
        $this->setUserID($userID);
        $this->setName($name);
        $this->setSurname($surname);
        $this->setEmail($email);
        $this->setPhone($phone);
        $this->setPassword($password);
        $this->setImage($image);
    }

    public function insertUser():bool{
        $query = <<<SQL
        INSERT INTO user_account (name,surname,phone,email,password,image)
        VALUES (:val1,:val2,:val3,:val4,:val5,:val6)
        SQL;

        $statement = $this->db->prepare($query);
        $statement->bindValue('val1', $this->getName());
        $statement->bindValue('val2', $this->getSurname());
        $statement->bindValue('val3', $this->getPhone());
        $statement->bindValue('val4', $this->getEmail());
        $statement->bindValue('val5',$this->getPassword());
        $statement->bindValue('val6',$this->getImage());

        if($this->connectDB->execute($statement))
            return true;
        elseif(!$this->connectDB->execute($statement))
            return false;
    }

    public function selectUser($field,$value):User{
        $query = <<<SQL
        SELECT * FROM user_account
        WHERE $field = :val1
        SQL;

        $statement = $this->db->prepare($query);
        $statement->bindValue('val1',$value);

        $this->connectDB->execute($statement);
        $numRows = $this->connectDB->getNumRows();
        $rows = $this->connectDB->getRows();

        $user = new User();
        if($numRows >= 1){
            foreach($rows as $row){
                $userID = $row['userID'];
                $name = $row['name'];
                $surname = $row['surname'];
                $email = $row['email'];
                $phone = $row['phone'];
                $password = $row['password'];
                $image = $row['image'];

                $user->initUser($userID,$name,$surname,$email,$phone,$password,$image);        
            }
        }
    
        return $user;
    }

    public function selectUserPassword($field,$value):string{
        $query = <<<SQL
        SELECT password FROM user_account
        WHERE $field = :val1
        SQL;

        $statement = $this->db->prepare($query);
        $statement->bindValue('val1',$value);

        $this->connectDB->execute($statement);
        $numRows = $this->connectDB->getNumRows();
        $rows = $this->connectDB->getRows();

        $password = "";
        if($numRows >= 1){
            foreach($rows as $row){
                $password = $row['password'];       
            }
        }
    
        return $password;
    }

    public function updateUser($whereField,$whereValue,$updateField,$updateValue):bool{
        $query = <<<SQL
        UPDATE user_account
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

    public function removeUser($fieldName,$value):bool{
        $query = <<<SQL
        DELETE FROM user_account
        WHERE $fieldName = :val1
        SQL;

        $statement = $this->db->prepare($query);
        $statement->bindValue('val1', $value);
        
        if($this->connectDB->execute($statement))
            return true;
        elseif(!$this->connectDB->execute($statement))
            return false;
    }

    public function setUserID($userID){
        $this->userID = $userID;
    }

    public  function getUserID(){
        return $this->userID;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getName(){
        return $this->name;
    }

    public function setSurname($surname){
        $this->surname = $surname;
    }

    public function getSurname(){
        return $this->surname;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setPhone($phone){
        $this->phone = $phone;
    }

    public function getPhone(){
        return $this->phone;
    }

    public function setPassword($password){
        $this->password = hash("sha256",$password);
    }

    public function getPassword(){
        return $this->password;
    }

    public function setImage($image){
        $this->image = $image;
    }

    public function getImage(){
        return $this->image;
    }

    public function uploadImage():void{
        $imagePath = "";
        $temp = $_FILES['pic']['tmp_name'];

        $new_name = md5(rand().time()).'.jpeg';
        $image_location = "../uploads/profile_pics/".$new_name;
        move_uploaded_file($temp,$image_location);
        
        $imageResource = imagecreatefromjpeg($image_location);//create resource from jpeg
        $resizedResource = imagescale($imageResource,"200","250",IMG_BILINEAR_FIXED);//resize image resource
        imagejpeg($resizedResource,$image_location,100);//create jpeg from the resized resource and replace original jpeg

        $imagePath = "http://127.0.0.1/Khangisa2/uploads/profile_pics/$new_name";   
        $this->setImage($imagePath);
    }

}
?>