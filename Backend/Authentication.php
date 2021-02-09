<?php
require_once("ConnectDB.php");
require_once("User.php");

class Authentication{
    private $userID;
    private $db = null;
    private $connectDB = null;
    
    public function __construct(){
        $this->db = ConnectDB::connect();
        $this->connectDB = new ConnectDB();
    }

    public function login($username,$password) : bool{
        $correct = false;

        $user = new User();
        $user->setPhone($username);
        $user->setPassword($password);

		if($username !== null && $password !== null){
			$query = <<<SQL
			SELECT userID FROM user_account
			WHERE phone = :val1 AND password = :val2
			SQL;

			$statement = $this->db->prepare($query);
			$statement->bindValue('val1',$user->getPhone());
			$statement->bindValue('val2',$user->getPassword());

            $this->connectDB->execute($statement);
            $numRows = $this->connectDB->getNumRows();
            $rows = $this->connectDB->getRows();

			if($numRows >= 1){
                foreach ($rows as $row) {
                    $correct = true;    
                    $this->setUserID($row['userID']);               
                }
			}else{
                $correct = false;
			}
        }
        return $correct;
    }

    function setUserID($userID){
        $this->userID = $userID;
    }

    function getUserID(){
        return $this->userID;
    }

}

?>