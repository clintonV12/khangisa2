<?php
require_once("config.php");

class ConnectDB{
	private $statement = null;

	public static function connect() : PDO{
		try{
			$server = Config::$DB_SERVER;
			$database = Config::$DB_DATABASE;
			
			$db = new PDO(
				"mysql:host=$server;dbname=$database",
				Config::$DB_USERNAME,
				Config::$DB_PASSWORD
				);
		}catch(PDOException $x){
			echo $x->getMessage();
		}
		
		$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		return $db;			
	}

	public function execute($statement): PDOStatement{
		$this->statement = $statement;

        if (!$this->statement->execute()) {
            throw new Exception($this->statement->errorInfo()[2]);
		}
		return $this->statement;
	}
	
	public function getStatement(){
		return $this->statement;
	}
	
	public function getNumRows():int{
        $numRows = $this->statement->rowCount();
		
		return $numRows;
    }
	
	public function getRows():array{
		$rows = $this->statement->fetchAll(PDO::FETCH_ASSOC);
		
		return $rows;
	}
	
	public function getLastInsertID(){
		$id = $this->statement->lastInsertId();
		return $id;
	}
}

?>