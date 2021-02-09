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
              <h1 class="page-title">Contact</h1>
              <ol class="breadcrumb">
                <li><a href="index.php">Home</a></li>
                <li class="active">Contact</li>
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
                <h2>GET IN TOUCH</h2>
              </div>
            </div>
            <div class="contact_information">
              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 adress_cont">
                <div class="information_bottom text_align_center">
                  <div class="icon_bottom"> <i class="fa fa-road" aria-hidden="true"></i> </div>
                  <div class="info_cont">
                    <h4>Gwamile street 35</h4>
                    <p>Mbabane Swaziland</p>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 adress_cont">
                <div class="information_bottom text_align_center">
                  <div class="icon_bottom"> <i class="fa fa-user" aria-hidden="true"></i> </div>
                  <div class="info_cont">
                    <h4>(+268) 7656 9900</h4>
                    <h4>(+268) 7695 9501</h4>
                    <p>Mon-Fri 8:30am-5:30pm</p>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 adress_cont">
                <div class="information_bottom text_align_center">
                  <div class="icon_bottom"> <i class="fa fa-envelope" aria-hidden="true"></i> </div>
                  <div class="info_cont">
                    <h4>info@buciko.com</h4>
                    <p>24/7 online support</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 contant_form">
              <h2 class="text_align_center">SEND MESSAGE</h2>
              <div class="form_section">
                <form class="form_contant" method="post" action="contact.php">
                  <fieldset>
                  <div class="row">
                    <div class="field col-lg-6 col-md-6 col-sm-12 col-xs-12">
                      <input class="field_custom" name="name" placeholder="First name" type="text" required="required">
                    </div>
                    <div class="field col-lg-6 col-md-6 col-sm-12 col-xs-12">
                      <input class="field_custom" name="surname" placeholder="Last name" type="text" required="required">
                    </div>
                    <div class="field col-lg-6 col-md-6 col-sm-12 col-xs-12">
                      <input class="field_custom" name="email" placeholder="Email adress" type="email" required="required">
                    </div>
                    <div class="field col-lg-6 col-md-6 col-sm-12 col-xs-12">
                      <input class="field_custom" name="phone" placeholder="Phone number" type="text" required="required">
                    </div>
                    <div class="field col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <textarea name="message" class="field_custom" placeholder="Messager" required="required"></textarea>
                    </div>
                    <div class="center"><button type="submit" class="btn main_bt">SUBMIT NOW</button></div>
                  </div>
                  </fieldset>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
@ $name = $_POST['name'];
@ $surname = $_POST['surname'];
@ $phone = $_POST['phone'];
@ $email = $_POST['email'];
@ $message = $_POST['message'];

if(isset($message) && !empty($message)){
  $to = "info@buciko.com";
  $subject = "User Message";
  $message = "<h1>Message sender:".$name." ".$surname."</h1><br><b>Phone number".$phone."</b><br><p>".$message."</p>";
  $header = "From:".$email."\r\n";
  $header .= "MIME-Version: 1.0\r\n";
  $header .= "Content-type: text/html\r\n";
  $retval = mail ($to,$subject,$message,$header);

  if( $retval == true )
  {
    echo "<script type='text/javascript'> alert('Message sent successfully...')</script>";
  }else{
    echo "<script type='text/javascript'> alert('Message could not be sent...')</script>";
  }
}
?>

<!-- section -->
<?php require_once("request_quote.php"); ?>

<script type="text/javascript" src="js/custom/contact.js"></script>  
<?php require_once("footer.php"); ?>