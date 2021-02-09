<?php 
session_start();
if(!isset($_SESSION['userID'])){
  require_once("header.php"); 
}else if(isset($_SESSION['userID'])){
  require_once("header2.php"); 
}
?>
<!-- inner page banner -->
<div id="inner_banner" class="section inner_banner_section">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="full">
          <div class="title-holder">
            <div class="title-holder-cell text-left">
              <h1 class="page-title">Explore our content</h1>
              <ol class="breadcrumb">
                <li><a href="index.php">Home</a></li>
                <li class="active">Explore</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end inner page banner -->
<!-- section -->
<?php require_once("product_search.php"); ?>
<!-- end section -->

<!-- section -->
<?php require_once("categories.php"); ?>
<!-- end section -->

<!-- section -->
<div class="section padding_layout_1 product_list_main">
  <div class="container">
    <div class="main_heading text_align_left">
      <h2>Featured ads</h2>
      <p class="large">We package the products with best services to make you a happy customer.</p>
    </div>
  <div class="row" id="posts"></div>
  </div><hr>
  <div id="pager" style="text-align: center; margin-top:5px;"></div>
</div>
<!-- end section -->

<?php require_once("request_quote.php"); ?>

<script type="text/javascript" src="js/custom/ajaxFunctions.js"></script>
<script type="text/javascript" src="js/custom/pagination.js"></script> 
<script type="text/javascript" src="js/custom/posts.js"></script> 
<?php require_once("footer.php"); ?>