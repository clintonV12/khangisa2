<?php 
require_once("ConnectDB.php");
require_once("Category.php");

class Post{
    private $postID;
    private $category;
    private $user;
    private $createDate;
    private $postTitle;
    private $postDetail;
    private $isActive;
    private $isSeller;
    private $isIndividual;
    private $expectedPrice;
    private $isPriceNegotiable;
    private $lastRenewedOn;
    private $rec_limit;//number of results per page
    private $db = null;
    private $connectDB = null;

    function __construct(){
        $this->db = ConnectDB::connect(); 
        $this->connectDB = new ConnectDB();
        $this->rec_limit = 15;
    }

    public function initPost($postID,$category,$user,$createDate,$postTitle,$postDetail,
    $isActive,$isSeller,$isIndividual,$expectedPrice,$isPriceNegotiable,$lastRenewedOn){
        $this->setPostID($postID);
        $this->setCategory($category);
        $this->setUser($user);
        $this->setCreateDate($createDate);
        $this->setPostTitle($postTitle);
        $this->setPostDetail($postDetail);
        $this->setIsActive($isActive);
        $this->setIsSeller($isSeller);
        $this->setIsIndividual($isIndividual);
        $this->setExpectedPrice($expectedPrice);
        $this->setIsPriceNegotiable($isPriceNegotiable);
        $this->setLastRenewedOn($lastRenewedOn);
    }

    public function insertPost():int{
        $query = <<<SQL
        INSERT INTO post (category,userID,create_date,post_title,post_detail,
        is_active,is_seller,is_individual,expected_price,is_price_negotiable,last_renewed_on)
        VALUES (:val1,:val2,:val3,:val4,:val5,:val6,:val7,:val8,:val9,:val10,:val11)
        SQL;

        $statement = $this->db->prepare($query);
        $statement->bindValue('val1', $this->getCategory());
        $statement->bindValue('val2', $this->getUser());
        $statement->bindValue('val3', $this->getCreateDate());
        $statement->bindValue('val4', $this->getPostTitle());
        $statement->bindValue('val5',$this->getPostDetail());
        $statement->bindValue('val6',$this->getIsActive());
        $statement->bindValue('val7',$this->getIsSeller());
        $statement->bindValue('val8',$this->getIsIndividual());
        $statement->bindValue('val9',$this->getExpectedPrice());
        $statement->bindValue('val10',$this->getIsPriceNegotiable());
        $statement->bindValue('val11',$this->getLastRenewedOn());
        $res = $this->connectDB->execute($statement);
        
        if($res)
            return $this->db->lastInsertId();
        elseif(!$res)
            return 0;
    }

    public function countAllPosts(){
        $query = <<<SQL
        SELECT COUNT(postID) FROM post
        SQL;

        $statement = $this->db->prepare($query);
        $this->connectDB->execute($statement);
        $rows = $this->connectDB->getStatement()->fetch(PDO::FETCH_NUM);
        $numRows = $rows[0];

        return $numRows;
    }

    public function countPostPerCategory($category){
        $query = <<<SQL
        SELECT COUNT(postID) FROM post
        WHERE category = :val1
        SQL;

        $statement = $this->db->prepare($query);
        $statement->bindValue('val1',$category);
        $this->connectDB->execute($statement);
        $rows = $this->connectDB->getStatement()->fetch(PDO::FETCH_NUM);
        $numRows = $rows[0];

        return $numRows;
    }

    public function selectPost($field,$value):Post{
        $query = <<<SQL
        SELECT * FROM post
        WHERE $field = :val1
        SQL;

        $statement = $this->db->prepare($query);
        $statement->bindValue('val1',$value);

        $this->connectDB->execute($statement);
        $numRows = $this->connectDB->getNumRows();
        $rows = $this->connectDB->getRows();

        $post = new Post();
        if($numRows >= 1){
            foreach($rows as $row){
                $postID = $row['postID'];
                $user = $row['userID'];
                $category = $row['category'];
                $createDate = $row['create_date'];
                $postTitle = $row['post_title'];
                $postDetail = $row['post_detail'];
                $isActive = $row['is_active'];
                $isSeller = $row['is_seller'];
                $isIndividual = $row['is_individual'];
                $expectedPrice = $row['expected_price'];
                $isPriceNegotiable = $row['is_price_negotiable'];
                $lastRenewedOn = $row['last_renewed_on'];

                $post->initPost($postID,$category,$user,$createDate,$postTitle,$postDetail,
                $isActive,$isSeller,$isIndividual,$expectedPrice,$isPriceNegotiable,$lastRenewedOn);        
            }
        }
        return $post;
    }

    public function selectAllPosts($page):array{
        $rec_count = $this->countAllPosts();
        $offset = (intval($page)-1)*$this->rec_limit;

        $query = <<<SQL
        SELECT * FROM post
        ORDER BY last_renewed_on DESC
        LIMIT $this->rec_limit OFFSET $offset
        SQL;

        $statement = $this->db->prepare($query);
        $this->connectDB->execute($statement);
        $numRows = $this->connectDB->getNumRows();
        $rows = $this->connectDB->getRows();

        $postArray = array();
        if($numRows >= 1){
            foreach($rows as $row){
                $postID = $row['postID'];
                $user = $row['userID'];
                $category = $row['category'];
                $createDate = $row['create_date'];
                $postTitle = $row['post_title'];
                $postDetail = $row['post_detail'];
                $isActive = $row['is_active'];
                $isSeller = $row['is_seller'];
                $isIndividual = $row['is_individual'];
                $expectedPrice = $row['expected_price'];
                $isPriceNegotiable = $row['is_price_negotiable'];
                $lastRenewedOn = $row['last_renewed_on'];
                
                $post = new Post();
                $post->initPost($postID,$category,$user,$createDate,$postTitle,$postDetail,
                $isActive,$isSeller,$isIndividual,$expectedPrice,$isPriceNegotiable,$lastRenewedOn);

                array_push($postArray,$post);
            }
        }
        return $postArray;
    }

    public function selectAllUserPosts($userID):array{
        $query = <<<SQL
        SELECT * FROM post
        WHERE userID = :val1
        ORDER BY last_renewed_on DESC
        SQL;

        $statement = $this->db->prepare($query);
        $statement->bindValue('val1',$userID);
        $this->connectDB->execute($statement);
        $numRows = $this->connectDB->getNumRows();
        $rows = $this->connectDB->getRows();

        $postArray = array();
        if($numRows >= 1){
            foreach($rows as $row){
                $postID = $row['postID'];
                $user = $row['userID'];
                $category = $row['category'];
                $createDate = $row['create_date'];
                $postTitle = $row['post_title'];
                $postDetail = $row['post_detail'];
                $isActive = $row['is_active'];
                $isSeller = $row['is_seller'];
                $isIndividual = $row['is_individual'];
                $expectedPrice = $row['expected_price'];
                $isPriceNegotiable = $row['is_price_negotiable'];
                $lastRenewedOn = $row['last_renewed_on'];
                
                $post = new Post();
                $post->initPost($postID,$category,$user,$createDate,$postTitle,$postDetail,
                $isActive,$isSeller,$isIndividual,$expectedPrice,$isPriceNegotiable,$lastRenewedOn);

                array_push($postArray,$post);
            }
        }
        return $postArray;
    }

    public function selectAllPostsByCategory($categoryID,$page):array{
        $rec_count = $this->countPostPerCategory($categoryID);
        $offset = (intval($page)-1)*$this->rec_limit;

        $query = <<<SQL
        SELECT * FROM post
        WHERE category = :val1
        ORDER BY last_renewed_on DESC
        LIMIT $this->rec_limit OFFSET $offset
        SQL;

        $statement = $this->db->prepare($query);
        $statement->bindValue('val1',$categoryID);
        
        $this->connectDB->execute($statement);
        $numRows = $this->connectDB->getNumRows();
        $rows = $this->connectDB->getRows();

        $postArray = array();
        if($numRows >= 1){
            foreach($rows as $row){
                $postID = $row['postID'];
                $user = $row['userID'];
                $category = $row['category'];
                $createDate = $row['create_date'];
                $postTitle = $row['post_title'];
                $postDetail = $row['post_detail'];
                $isActive = $row['is_active'];
                $isSeller = $row['is_seller'];
                $isIndividual = $row['is_individual'];
                $expectedPrice = $row['expected_price'];
                $isPriceNegotiable = $row['is_price_negotiable'];
                $lastRenewedOn = $row['last_renewed_on'];
                
                $post = new Post();
                $post->initPost($postID,$category,$user,$createDate,$postTitle,$postDetail,
                $isActive,$isSeller,$isIndividual,$expectedPrice,$isPriceNegotiable,$lastRenewedOn);

                array_push($postArray,$post);
            }
        }
        return $postArray;
    }

    public function searchPost($searchString) : array{
        $query = <<<SQL
        SELECT * FROM post
        WHERE post_title LIKE :name
        OR post_detail LIKE :name
        OR category LIKE :name
        ORDER BY last_renewed_on DESC
        SQL;
        
        $statement = $this->db->prepare($query);
        $statement->bindValue('name',"%".$searchString."%");
        
        $this->connectDB->execute($statement);
        $numRows = $this->connectDB->getNumRows();
        $rows = $this->connectDB->getRows();

        $postArray = array();
        if($numRows >= 1){
            foreach($rows as $row){
                $postID = $row['postID'];
                $user = $row['userID'];
                $category = $row['category'];
                $createDate = $row['create_date'];
                $postTitle = $row['post_title'];
                $postDetail = $row['post_detail'];
                $isActive = $row['is_active'];
                $isSeller = $row['is_seller'];
                $isIndividual = $row['is_individual'];
                $expectedPrice = $row['expected_price'];
                $isPriceNegotiable = $row['is_price_negotiable'];
                $lastRenewedOn = $row['last_renewed_on'];
                
                $post = new Post();
                $post->initPost($postID,$category,$user,$createDate,$postTitle,$postDetail,
                $isActive,$isSeller,$isIndividual,$expectedPrice,$isPriceNegotiable,$lastRenewedOn);

                array_push($postArray,$post);
            }
        }
        return $postArray;
    }

    public function updatePost($whereField,$whereValue,$updateField,$updateValue):bool{
        $query = <<<SQL
        UPDATE post
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

    public function removePost($fieldName,$value):bool{
        $query = <<<SQL
        DELETE FROM post
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

    public function setCategory($category){
        $this->category = $category;
    }

    public function getCategory(){
        return $this->category;
    }

    public function setUser($user){
        $this->user = $user;
    }

    public function getUser(){
        return $this->user;
    }

    public function setCreateDate($createDate){
        $this->createDate = $createDate;
    }

    public function getCreateDate(){
        return $this->createDate;
    }

    public function setPostTitle($postTitle){
        $this->postTitle = $postTitle;
    }

    public function getPostTitle(){
        return $this->postTitle;
    }

    public function setPostDetail($postDetail){
        $this->postDetail = $postDetail;
    }

    public function getPostDetail(){
        return $this->postDetail;
    }

    public function setIsActive($isActive){
        $this->isActive = $isActive;
    }

    public function getIsActive(){
        return $this->isActive;
    }

    public function setIsSeller($isSeller){
        $this->isSeller = $isSeller;
    }

    public function getIsSeller(){
        return $this->isSeller;
    }

    public function setIsIndividual($isIndividual){
        $this->isIndividual = $isIndividual;
    }

    public function getIsIndividual(){
        return $this->isIndividual;
    }

    public function setExpectedPrice($expectedPrice){
        $this->expectedPrice = $expectedPrice;
    }

    public function getExpectedPrice(){
        return $this->expectedPrice;
    }

    public function setIsPriceNegotiable($isPriceNegotiable){
        $this->isPriceNegotiable = $isPriceNegotiable;
    }

    public function getIsPriceNegotiable(){
        return $this->isPriceNegotiable;
    }

    public function setLastRenewedOn($lastRenewedOn){
        $this->lastRenewedOn = $lastRenewedOn;
    }

    public function getLastRenewedOn(){
        return $this->lastRenewedOn;
    }
    
}

?>