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
              <h1 class="page-title">My Messages</h1>
              <ol class="breadcrumb">
                <li><a href="index.php">Home</a></li>
                <li class="active">My messages</li>
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
          <div class="full" id="msgArea">
            
        </div>
      </div>
    </div>
  </div>
</div>
<!-- section -->
<div class="section padding_layout_1 testmonial_section white_fonts"></div>
<!-- end section -->

<script type="text/javascript" src="js/custom/ajaxFunctions.js"></script>
<script type="text/javascript" src="js/custom/navigation.js"></script>
<script type="text/javascript" src="js/custom/my_messages.js"></script>  
<?php require_once("footer.php"); ?>