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
              <h1 class="page-title">Sign Up to Buciko</h1>
              <ol class="breadcrumb">
                <li><a href="index.php">Home</a></li>
                <li class="active">Sign Up</li>
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
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="main_heading text_align_center">
                <h2>Sign Up</h2>
              </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 appointment_form">
              <div class="form_section">
                <div class="form_contant">
                  <fieldset>
                  <div class="row">
                    <div class="field col-lg-6 col-md-6 col-sm-12 col-xs-12">
                      <input id="name" class="field_custom" placeholder="First Name" type="text" required>
                    </div>
                    <div class="field col-lg-6 col-md-6 col-sm-12 col-xs-12">
                      <input id="surname" class="field_custom" placeholder="Last Name" type="text" required>
                    </div>
                    <div class="field col-lg-6 col-md-6 col-sm-12 col-xs-12">
                      <input id="email" class="field_custom" placeholder="Your Email" type="email" required>
                    </div>
                    <div class="field col-lg-6 col-md-6 col-sm-12 col-xs-12">
                      <input id="phone" class="field_custom" placeholder="Your Phone Number" type="number" required>
                    </div>
                    <div class="field col-lg-6 col-md-6 col-sm-12 col-xs-12">
                      <input id="password1" class="field_custom" placeholder="Set Password" type="password" required>
                    </div>
                    <div class="field col-lg-6 col-md-6 col-sm-12 col-xs-12">
                      <input id="password2" class="field_custom" placeholder="Confirm Password" type="password" required>
                    </div>
                    
                    <div class="field col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <input id="pic" class="adContent" type="file">
                    </div>

                    <div style="text-align: center;" class="field col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <progress class="progressBar" id="progressBar" style="display: none;" value="0" max="100"></progress>
                      <h5 id="status"></h5>
                    </div>
                    
                    <div class="center">
                      <button class="btn main_bt" onclick="submitUserInfo()">SUBMIT</button>
                    </div>
                  </div>
                  </fieldset>
              </div>
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
<!-- section -->
<div class="section">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="full">
          <div class="contact_us_section">
            <div class="call_icon"> <img src="images/it_service/phone_icon.png" alt="#" /> </div>
            <div class="inner_cont">
              <h2>REQUEST A FREE QUOTE</h2>
              <p>Get answers and advice from people you want it from.</p>
            </div>
            <div class="button_Section_cont"> <a class="btn dark_gray_bt" href="contact.php">Contact us</a> </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end section -->

<!-- section -->
<div class="section padding_layout_1" style="padding: 50px 0;"></div>
<!-- end section -->

<script type="text/javascript" src="js/custom/ajaxFunctions.js"></script>
<script type="text/javascript" src="js/custom/progress.js"></script>
<script type="text/javascript" src="js/custom/signup.js"></script>  
<?php require_once("footer.php"); ?>