<?php 
session_start();
if(!isset($_SESSION['userID'])){
  require_once("header.php"); 
}else if(isset($_SESSION['userID'])){
  require_once("header2.php"); 
}
?>


<div id="slides" class="carousel slide" data-ride="carousel">
  <ul class="carousel-indicators">
    <li data-target="#slides" data-slide-to="0" class="active"></li>
    <li data-target="#slides" data-slide-to="1" class="active"></li>
    <li data-target="#slides" data-slide-to="2" class="active"></li>
  </ul>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="images/it_service/home.jpg">
      <div class="carousel-caption">
        <h1 class="display-2">Buciko</h1>
        <h3>Start advertising for free</h3>
        <button type="button" onclick="openPosts()" class="btn btn-primary btn-lg">View ads</button>
        <button type="button" onclick="openSignup()" class="btn btn-primary btn-lg">Get Started</button>
      </div>
    </div>
    <div class="carousel-item">
      <img src="images/it_service/home_01.jpg">
      <div class="carousel-caption">
        <h1 class="display-2">Buciko</h1>
        <h3>Find the perfect deal in our wide variety of ads</h3>
        <button type="button" onclick="openPosts()" class="btn btn-primary btn-lg">View ads</button>
        <button type="button" onclick="openSignup()" class="btn btn-primary btn-lg">Get Started</button>
      </div>
    </div>
    <div class="carousel-item">
      <img src="images/it_service/results.jpg">
      <div class="carousel-caption">
        <h1 class="display-2">Buciko</h1>
        <h3>Get the word out about your business</h3>
        <button type="button" onclick="openPosts()" class="btn btn-primary btn-lg">View ads</button>
        <button type="button" onclick="openSignup()" class="btn btn-primary btn-lg">Get Started</button>
      </div>
    </div>
  </div> 
</div>
<!-- end section -->

<!-- section -->
<?php require_once("product_search.php"); ?>
<!-- end section -->

<!-- section -->
<?php require_once("categories.php"); ?>
<!-- end section -->

<!-- section -->
<div class="section padding_layout_1">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="full">
          <div class="main_heading text_align_left">
            <h2>Latest adverts</h2>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 lastPost" id="1" onclick="openDetails(this.id)">
        <div class="full blog_colum">
          <div class="blog_feature_img"> <img id="img1" src="images/it_service/no-image.jpg" alt="#" /> </div>
          <div class="post_time">
            <p><i class="fa fa-clock-o"></i> <b id="date1">January 01, 2021</b></p>
          </div>
          <div class="blog_feature_head">
            <h4 id="title1">No adverts posted yet.</h4>
          </div>
          <div class="blog_feature_cont">
            <p id="desc1">No adverts posted yet...as soon as they are available they will be shown here.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4 lastPost" id="2" onclick="openDetails(this.id)">
        <div class="full blog_colum">
          <div class="blog_feature_img"> <img id="img2" src="images/it_service/no-image.jpg" alt="#" /> </div>
          <div class="post_time">
            <p><i class="fa fa-clock-o"></i> <b id="date2">January 01, 2021</b></p>
          </div>
          <div class="blog_feature_head">
            <h4 id="title2">No adverts posted yet.</h4>
          </div>
          <div class="blog_feature_cont">
            <p id="desc2">No adverts posted yet...as soon as they are available they will be shown here.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4 lastPost" id="3" onclick="openDetails(this.id)">
        <div class="full blog_colum">
          <div class="blog_feature_img"> <img id="img3" src="images/it_service/no-image.jpg" alt="#" /> </div>
          <div class="post_time">
            <p><i class="fa fa-clock-o"></i> <b id="date3">January 01, 2021</b></p>
          </div>
          <div class="blog_feature_head">
            <h4 id="title3">No adverts posted yet.</h4>
          </div>
          <div class="blog_feature_cont">
            <p id="desc3">No adverts posted yet...as soon as they are available they will be shown here.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end section -->

<!-- section -->
<div class="section padding_layout_1">
  <div class="container" >
    <div class="row">
      <div class="col-md-12">
        <div class="full">
          <div class="main_heading text_align_left">
            <h2>Featured ads</h2>
            <p class="large">We package the products with best services to make you a happy customer.</p>
          </div>
        </div>
      </div>
    </div>
    
    <div class="row" id="featured"></div>
    
  </div>
</div>
<!-- end section -->
<?php require_once("request_quote.php"); ?>

<script type="text/javascript" src="js/custom/ajaxFunctions.js"></script>
<script type="text/javascript" src="js/custom/navigation.js"></script>  
<script type="text/javascript" src="js/custom/index.js"></script>  
<?php require_once("footer.php"); ?>