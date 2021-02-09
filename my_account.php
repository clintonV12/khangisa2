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
              <h1 class="page-title">My account</h1>
              <ol class="breadcrumb">
                <li><a href="index.php">Home</a></li>
                <li class="active">My account</li>
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
      <div class="col-md-12" style = "background-color:#17a5e9; width: 100%; border-radius: 5px;">
        <div class="full">
          <div class="main_heading2 text_align_center">
            <h2 style="color: #fff;">My account</h2>
            <p class="large" style="color: #fff;">Manage all your account settings here.</p>
          </div>
        </div>
      </div>

      <div class="row" style="margin-top: 35px;">
        <div class="col-md-8">
          <div class="full margin_bottom_30">
            <div class="accordion border_circle">
              <div class="bs-example">
                <div class="panel-group" id="accordion">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <p class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><i class="fa fa-folder-open" aria-hidden="true"></i> Manage my ads<i class="fa fa-angle-down"></i></a> </p>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in">
                      <div class="panel-body">
                        <div id="manage">
                          <h3>Hi <b id="userName"></b></h3>
                          <p>You currently have <a id="numPosts" href="#"></a> active ad(s). <a href="my_posts.php">View your active ads here</a></p>
                          <div style="text-align: center; background-color: #ccc; padding: 10px;">
                              <p>Have something you want to advertise?</p>
                              <span class="fa fa-upload" style="font-size: 50px;"></span><br><br>
                              <button class="btn main_bt" onclick="openPostContent()">Post an ad</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <p class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"><i class="fa fa-envelope"></i> My Messages<i class="fa fa-angle-down"></i></a> </p>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse">
                      <div class="panel-body">
                        <div id="messages">
                          <h3 id="email"></h3>
                          <div style="text-align: center; background-color: #ccc; padding: 10px;">
                              <span class="fa fa-envelope" style="font-size: 50px;"></span><br>
                              <p>You currently have <a id="numMsg" href="#"></a> message(s). <a href="#" onclick="openMyMessages()">Click here to open</a></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <p class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive"><i class="fa fa-user" aria-hidden="true"></i> My details<i class="fa fa-angle-down"></i></a> </p>
                    </div>
                    <div id="collapseFive" class="panel-collapse collapse in">
                      <div class="panel-body">
                        <div id="details">
                          <div class="m_row">
                            <h4>Name</h4>
                            <input class="field_custom" style="width: 100%;" type="text" id="userName2">                
                          </div>
                          
                          <div class="m_row">
                            <h4>Surname</h4>
                            <input class="field_custom" style="width: 100%;" type="text" id="userSurname">                           
                          </div>

                          <div class="m_row">
                            <h4>Email</h4>
                            <input class="field_custom" style="width: 100%;" type="text" id="userEmail">                                                     
                          </div>
                          
                          <div class="m_row">
                            <h4>Contact number</h4>
                            <input class="field_custom" style="width: 100%;" type="number" id="userPhone">                        
                          </div>

                          <div class="m_row">
                            <h4>Image</h4>
                            <img id="userImage" style="margin-bottom:10px; border-radius: 50%; width:200px; height:200px;">
                            <input class="adContent" style="width: 100%;" type="file" id="userNewImage">                        
                          </div>

                          <hr>
                          <button class="btn main_bt" onclick="updateProfile()">Update profile</button>
                          
                        </div>

                      </div>
                    </div>
                  </div>

                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <p class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapseSec"><i class="fa fa-lock" aria-hidden="true"></i> Security<i class="fa fa-angle-down"></i></a> </p>
                    </div>
                    <div id="collapseSec" class="panel-collapse collapse in">
                      <div class="panel-body">
                        <div id="details">
                          <div class="m_row">
                            <h4>Current Password</h4>
                            <input placeholder="Enter current password here..." class="field_custom" style="width: 100%;" type="password" id="pass1">                
                          </div>

                          <div class="m_row">
                            <h4>New Password</h4>
                            <input placeholder="Enter new password here..." class="field_custom" style="width: 100%;" type="password" id="pass2">                
                          </div>

                          <div class="m_row">
                            <h4>Confirm New Password</h4>
                            <input placeholder="Confirm new password here..." class="field_custom" style="width: 100%;" type="password" id="pass3">                
                          </div>

                          <hr>
                          <button class="btn main_bt" onclick="updatePassword()">change password</button>
                        </div>
                      </div>

                    </div>
                  </div>
                

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


<script type="text/javascript" src="js/custom/ajaxFunctions.js"></script>
<script type="text/javascript" src="js/custom/navigation.js"></script>
<script type="text/javascript" src="js/custom/my_account.js"></script>  
<?php require_once("footer.php"); ?>