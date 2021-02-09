<?php 
session_start();
if(!isset($_SESSION['userID'])){
  header("location: signin.php");
  exit();
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
              <h1 class="page-title">Post Ad</h1>
              <ol class="breadcrumb">
                <li><a href="index.php">Home</a></li>
                <li class="active">Post Ad</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end inner page banner -->
<div class="section padding_layout_1">
  <div class="container">
    <div class="row">
      <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-xs-12"></div>
      <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-xs-12">
        <div class="row">
          <div class="full">
            
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 contant_form">
              <h2 class="text_align_center">Post an advert</h2>
              <div class="adParent" >
                <input id="title" class="adContent" type="text" placeholder="Enter title">
                
                <select id="category" class="adContent">
                    <option value="">Choose Category</option>
                    <option value="Vehicles">Vehicles</option>
                    <option value="Property">Property</option>
                    <option value="Electronics">Electronics</option>
                    <option value="ForSale">For Sale</option>
                    <option value="Jobs">Jobs</option>
                    <option value="Other">Other</option>
                </select>

                <select id="userType" class="adContent">
                    <option value="">I want to</option>
                    <option value="Buyer">Buy</option>
                    <option value="Seller">Sell</option>
                </select>

                <select id="userClass" class="adContent">
                    <option value="">I am representing</option>
                    <option value="Company"> a company</option>
                    <option value="Individual">an individual</option>
                </select>

                <input id="price" class="adContent" type="number" placeholder="Expected price .e.g 1200.00">

                <select id="priceType" class="adContent">
                    <option value="">Price is</option>
                    <option value="Vehicles">Negotiable</option>
                    <option value="Property">Non-negotiable</option>
                </select>

                <textarea id="description" class="adDesc" rows="4" placeholder="Enter description of what you are posting"></textarea>

                <input id="adImage" class="adContent" type="file">
                
                <progress class="progressBar" id="progressBar" style="display: none;" value="0" max="100"></progress>
                <h5 id="status"></h5>

                <button class="btn main_bt postAdBtn" onclick="makePost()">Post</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- section -->
<div class="section padding_layout_1 testmonial_section white_fonts"></div>
<!-- end section -->

<script type="text/javascript" src="js/custom/ajaxFunctions.js"></script>
<script type="text/javascript" src="js/custom/progress.js"></script>
<script type="text/javascript" src="js/custom/post_content.js"></script>  
<?php require_once("footer.php"); ?>