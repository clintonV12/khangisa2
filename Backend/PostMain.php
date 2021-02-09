<?php
session_start();
require_once("User.php");
require_once("Post.php");
require_once("Review.php");
require_once("PostImage.php");
require_once("PostStatistic.php");

@ $postInfo = $_POST['postInfo'];
@ $category = $_POST['category'];
@ $title = $_POST['title'];
@ $details = $_POST['detail'];
@ $price = $_POST['price'];
@ $priceNegotiable = $_POST['isPriceNegotiable'];
@ $isSeller = $_POST['isSeller'];
@ $isIndividual = $_POST['isIndividual'];

@ $allPosts = $_POST['allPosts'];
@ $selectedCategory = $_POST['selectedCategory'];
@ $currentPage = $_POST['page'];

@ $postID = $_POST['post'];
@ $userPosts = $_POST['userPosts'];

//reviews
@ $reviewPost = $_POST['reviewPost'];
@ $reviewText = $_POST['reviewText'];

//search products
@ $searchString = $_POST['searchString'];

//my posts
@ $allMyPost = $_POST['allMyPost'];

//delete post
@ $delPostID = $_POST['delPostID'];

$response = array();
@ $userID = $_SESSION['userID'];

if(isset($postInfo) && !empty($postInfo)){
    $post = new Post();
    $post->setUser($userID);
    $post->setCategory($category);
    $post->setCreateDate(time());
    $post->setPostTitle($title);
    $post->setIsActive('Y');
    $post->setIsSeller($isSeller);
    $post->setIsIndividual($isIndividual);
    $post->setPostDetail($details);
    $post->setExpectedPrice($price);
    $post->setIsPriceNegotiable($priceNegotiable);
    $post->setLastRenewedOn(time());
    $postID = $post->insertPost();

    $postStat = new PostStatistic();
    $postStat->insertPostStatistic($postID,0,0);

    $postImage = new PostImage();
    $postImage->uploadImage();
    $postImage->setPostID($postID);
    $res = $postImage->insertPostImage();

    if($res){
        array_push($response,array("Result"=>"successfuly"));
        echo json_encode($response);
    }elseif(!$res){
        array_push($response,array("Result"=>"not successfuly"));
        echo json_encode($response);
    }
}elseif(isset($selectedCategory) && !empty($selectedCategory)){
    $post = new Post();
    $posts = $post->selectAllPostsByCategory($selectedCategory,$currentPage);  
    $numRows = $post->countPostPerCategory($selectedCategory);
    
    foreach($posts as $ad){
        $postID = $ad->getPostID();
        $postImage = new PostImage();
        $images = $postImage->selectPostImage("postID",$postID);

        $temp = array();
        $temp['numRows'] = $numRows;
        $temp['postID'] = $ad->getPostID();
        $temp['user'] = $ad->getUser();
        $temp['category'] = $ad->getCategory();
        $temp['createDate'] = date("Y-m-d H:i:s", $ad->getCreateDate());
        $temp['postTitle'] = $ad->getPostTitle();
        $temp['postDetail'] = $ad->getPostDetail();
        $temp['isActive'] = $ad->getIsActive();
        $temp['isSeller'] = $ad->getIsSeller();
        $temp['isIndividual'] = $ad->getIsIndividual();
        $temp['expectedPrice'] = $ad->getExpectedPrice();
        $temp['isPriceNegotiable'] = $ad->getIsPriceNegotiable();
        $temp['lastRenewedOn'] = $ad->getLastRenewedOn();
        $temp['images'] = $images;
        
        array_push($response,$temp);
    }
    echo json_encode($response);

}elseif(isset($allPosts) && !empty($allPosts)){
    $post = new Post();
    $posts = $post->selectAllPosts($currentPage);
    $numRows = $post->countAllPosts();

    foreach($posts as $ad){
        $postID = $ad->getPostID();
        $postImage = new PostImage();
        $images = $postImage->selectPostImage("postID",$postID);

        $temp = array();
        $temp['numRows'] = $numRows;
        $temp['postID'] = $ad->getPostID();
        $temp['user'] = $ad->getUser();
        $temp['category'] = $ad->getCategory();
        $temp['createDate'] = date("Y-m-d H:i:s", $ad->getCreateDate());
        $temp['postTitle'] = $ad->getPostTitle();
        $temp['postDetail'] = $ad->getPostDetail();
        $temp['isActive'] = $ad->getIsActive();
        $temp['isSeller'] = $ad->getIsSeller();
        $temp['isIndividual'] = $ad->getIsIndividual();
        $temp['expectedPrice'] = $ad->getExpectedPrice();
        $temp['isPriceNegotiable'] = $ad->getIsPriceNegotiable();
        $temp['lastRenewedOn'] = $ad->getLastRenewedOn();
        $temp['images'] = $images;
        
        array_push($response,$temp);
    }
    echo json_encode($response);
}elseif(isset($postID) && !empty($postID)){
    $post = new Post();
    $selectedPost = $post->selectPost("postID",$postID);

    if($selectedPost->getUser() != $userID){
        $postStat = new PostStatistic();
        $ps = $postStat->selectPostStatistic("postID",$postID);
        $postStat->updatePostStatistic("postID",$postID,"views",$ps->getViews()+1);
        $postStat->updatePostStatistic("postID",$postID,"last_viewed_on",time());
    }

    $postImage = new PostImage();
    $images = $postImage->selectPostImage("postID",$postID);

    $temp = array();
    $temp['postID'] = $selectedPost->getPostID();
    $temp['user'] = $selectedPost->getUser();
    $temp['category'] = $selectedPost->getCategory();
    $temp['createDate'] = date("Y-m-d H:i:s", $selectedPost->getCreateDate());
    $temp['postTitle'] = $selectedPost->getPostTitle();
    $temp['postDetail'] = $selectedPost->getPostDetail();
    $temp['isActive'] = $selectedPost->getIsActive();
    $temp['isSeller'] = $selectedPost->getIsSeller();
    $temp['isIndividual'] = $selectedPost->getIsIndividual();
    $temp['expectedPrice'] = $selectedPost->getExpectedPrice();
    $temp['isPriceNegotiable'] = $selectedPost->getIsPriceNegotiable();
    $temp['images'] = $images;

    $user = new User();
    $p_user = $user->selectUser("userID",$selectedPost->getUser());    
    $temp['name'] = $p_user->getName();
    $temp['surname'] = $p_user->getSurname();
    $temp['phone'] = $p_user->getPhone();
    $temp['email'] = $p_user->getEmail();
    $temp['image'] = $p_user->getImage(); 

    $review = new Review();
    $reviews = array();
    $allRevs = $review->selectAllReviews("postID",$postID);

    foreach($allRevs as $rev){
        $reviewArray = array();
        $reviewArray['reviewID'] = $rev->getReviewID();
        $reviewArray['postID'] = $rev->getPostID();
        $reviewArray['reviewSenderID'] = $rev->getReviewSenderID();
        $reviewArray['reviewText'] = $rev->getReviewText();
        $reviewArray['reviewDate'] = date("Y-m-d H:i:s", $rev->getReviewDate());

        $u = new User();
        $r_user = $u->selectUser("userID",$rev->getReviewSenderID());    
        $reviewArray['name'] = $r_user->getName();
        $reviewArray['surname'] = $r_user->getSurname();
        $reviewArray['phone'] = $r_user->getPhone();
        $reviewArray['email'] = $r_user->getEmail();
        $reviewArray['image'] = $r_user->getImage(); 
        array_push($reviews,$reviewArray);
    }
    $temp['reviews'] = $reviews;

    array_push($response,$temp);

    $related = $post->selectAllPostsByCategory($selectedPost->getCategory(),1);
    $count = 0;
    foreach($related as $r){
        $temp = array();
        $temp['postID'] = $r->getPostID();
        $temp['user'] = $r->getUser();
        $temp['category'] = $r->getCategory();
        $temp['createDate'] = date("Y-m-d H:i:s", $r->getCreateDate());
        $temp['postTitle'] = $r->getPostTitle();
        $temp['postDetail'] = $r->getPostDetail();
        $temp['isActive'] = $r->getIsActive();
        $temp['isSeller'] = $r->getIsSeller();
        $temp['isIndividual'] = $r->getIsIndividual();
        $temp['expectedPrice'] = $r->getExpectedPrice();
        $temp['isPriceNegotiable'] = $r->getIsPriceNegotiable();
        $images = $postImage->selectPostImage("postID",$r->getPostID());
        $temp['images'] = $images;
        array_push($response,$temp);

        $count += 1;
        if($count >= 3)
            break;
    }

    echo json_encode($response);
}elseif(isset($userPosts) && !empty($userPosts)){
    $post = new Post();
    $posts = $post->selectAllUserPosts($userID);

    foreach($posts as $ad){
        $postID = $ad->getPostID();
        $postImage = new PostImage();
        $images = $postImage->selectPostImage("postID",$postID);

        $temp = array();
        $temp['postID'] = $ad->getPostID();
        $temp['user'] = $ad->getUser();
        $temp['category'] = $ad->getCategory();
        $temp['createDate'] = date("Y-m-d H:i:s", $ad->getCreateDate());
        $temp['postTitle'] = $ad->getPostTitle();
        $temp['postDetail'] = $ad->getPostDetail();
        $temp['isActive'] = $ad->getIsActive();
        $temp['isSeller'] = $ad->getIsSeller();
        $temp['isIndividual'] = $ad->getIsIndividual();
        $temp['expectedPrice'] = $ad->getExpectedPrice();
        $temp['isPriceNegotiable'] = $ad->getIsPriceNegotiable();
        $temp['lastRenewedOn'] = $ad->getLastRenewedOn();
        $temp['images'] = $images;
        
        array_push($response,$temp);
    }
    echo json_encode($response);
}if(isset($reviewPost) && !empty($reviewPost)){
    
    if($userID == null){
        array_push($response,array("Result"=>"not sent.\nYou must be logged in to be able to leave reviews."));
        echo json_encode($response);
    }else{
        $review = new Review();
        $res = $review->addReview($reviewPost,$userID,$reviewText,time());

        if($res){
            array_push($response,array("Result"=>"successfuly sent."));
            echo json_encode($response);
        }elseif(!$res){
            array_push($response,array("Result"=>"not successfuly sent."));
            echo json_encode($response);
        }
    }
}elseif(isset($searchString) && !empty($searchString)){
    $post = new Post();
    $posts = $post->searchPost($searchString);

    foreach($posts as $ad){
        $postID = $ad->getPostID();
        $postImage = new PostImage();
        $images = $postImage->selectPostImage("postID",$postID);

        $temp = array();
        $temp['postID'] = $ad->getPostID();
        $temp['user'] = $ad->getUser();
        $temp['category'] = $ad->getCategory();
        $temp['createDate'] = date("Y-m-d H:i:s", $ad->getCreateDate());
        $temp['postTitle'] = $ad->getPostTitle();
        $temp['postDetail'] = $ad->getPostDetail();
        $temp['isActive'] = $ad->getIsActive();
        $temp['isSeller'] = $ad->getIsSeller();
        $temp['isIndividual'] = $ad->getIsIndividual();
        $temp['expectedPrice'] = $ad->getExpectedPrice();
        $temp['isPriceNegotiable'] = $ad->getIsPriceNegotiable();
        $temp['lastRenewedOn'] = $ad->getLastRenewedOn();
        $temp['images'] = $images;
        
        array_push($response,$temp);
    }
    echo json_encode($response);
}elseif(isset($allMyPost) && !empty($allMyPost)){
    $post = new Post();
    $posts = $post->selectAllUserPosts($userID);

    foreach($posts as $ad){
        $postID = $ad->getPostID();
        
        $postStat = new PostStatistic();
        $stats = $postStat->selectPostStatistic("postID",$postID);

        $temp = array();
        $temp['postID'] = $ad->getPostID();
        $temp['category'] = $ad->getCategory();
        $temp['createDate'] = date("Y-m-d H:i:s", $ad->getCreateDate());
        $temp['postTitle'] = $ad->getPostTitle();
        $temp['postDetail'] = $ad->getPostDetail();
        $temp['expectedPrice'] = $ad->getExpectedPrice();
        $temp['lastViewDate'] = date("Y-m-d H:i:s",$stats->getLastViewedOn());
        $temp['views'] = $stats->getViews();
        
        array_push($response,$temp);
    }
    echo json_encode($response);
}elseif(isset($delPostID) && !empty($delPostID)){
    
    $post = new Post();
    $res = $post->removePost("postID",$delPostID);

    $postStat = new PostStatistic();
    $res = $postStat->removePostStatistic("postID",$delPostID);

    $postImage = new PostImage();
    //delete ad image file
    $imgs = $postImage->selectPostImage("postID",$delPostID);
    foreach($imgs as $img){
        $imgArray = preg_split("{/}",$img,NULL,NULL);
        $size = sizeof($imgArray);
        $imageName = $imgArray[$size-1];
        @ unlink('../uploads/adImages/'.$imageName);
    }
    $res = $postImage->removePostImage("postID",$delPostID);

    $rev = new Review();
    $res = $rev->removeReview("postID",$delPostID);

    if($res){
        array_push($response,array("Result"=>"successfuly"));
        echo json_encode($response);
    }elseif(!$res){
        array_push($response,array("Result"=>"not successfuly"));
        echo json_encode($response);
    }
}

?>