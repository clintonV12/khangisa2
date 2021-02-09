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
              <h1 class="page-title">Details</h1>
              <ol class="breadcrumb">
                <li><a href="index.php">Home</a></li>
                <li class="active">Details</li>
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
<div class="section padding_layout_1 product_detail">
  <div class="container">
    <div class="row">
      <div class="col-md-9">
        <div class="row">
          <div class="col-xl-6 col-lg-12 col-md-12">
            <div class="product_detail_feature_img hizoom hi2">
              <div class='hizoom hi2'> <img id="postImg" src="" alt="#" /> </div>
            </div>
          </div>
          <div class="col-xl-6 col-lg-12 col-md-12 product_detail_side detail_style1">
            <div class="product-heading">
              <h2 id="title"></h2>
            </div>
            <div class="product-detail-side"> 
              <span class="new-price">Price: <b>E</b><b id="price"></b> </span> 
               
            </div>
            
              <div class="detail-contant">
                <p id="neg"></p>
                <p id="ut"></p>
                
                <span class="review"><b><i class="fa fa-clock-o"></i> Posted on:</b> <b id="date"></b></span>

                <div class="row">
                  <div class="col-sm-12">
                    <div class="full review_bt_section">
                      <div class="float-left"> <a class="btn sqaure_bt" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Contact owner</a> </div>
                    </div>
                    <div class="full">
                      <div id="collapseExample" class="full collapse commant_box">
                        <div>
                          <input id="ratings-hidden" name="rating" type="hidden">
                          <textarea class="form-control animated" id="ownerMsg" cols="50" id="new-review" name="comment" placeholder="Enter your message here..." required=""></textarea>
                          <div class="full_bt center">
                            <button class="btn sqaure_bt" name="ownerContactBtn" onclick="sendOwnerMessage(this.id)">Send</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>           
              </div>

            <div class="share-post"> <a href="#" class="share-text">Share</a>
              <ul class="social_icons">
                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-whatsapp" aria-hidden="true"></i></a></li>
              </ul>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="full">
              <div class="tab_bar_section">
                <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#description">Description</a> </li>
                  <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#reviews">Reviews (<b id="reviewNum"></b>)</a> </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                  <div id="description" class="tab-pane active">
                    <div class="product_desc">
                      <p id="desc2"></p>
                    </div>
                  </div>

                  <div id="reviews" class="tab-pane fade">
                    <div class="product_review">
                      <h3>Reviews (<b id="reviewNum2"></b>)</h3>
                      <div id="reviewDisplay"></div>
                      
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="full review_bt_section">
                            <div class="float-right"> <a class="btn sqaure_bt" data-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample">Leave a Review</a> </div>
                          </div>
                          <div class="full">
                            <div id="collapseExample2" class="full collapse commant_box">
                              <form>
                                <input id="ratings-hidden" name="rating" type="hidden">
                                <textarea class="form-control animated" cols="50" id="new-review" name="comment" placeholder="Enter your review here..." required=""></textarea>
                                <div class="full_bt center">
                                  <button class="btn sqaure_bt" name="saveReview" onclick="sendReview(this.id)">Save</button>
                                </div>
                              </form>
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

        <div class="row">
          <div class="col-md-12">
            <div class="full">
              <div class="main_heading text_align_left" style="margin-bottom: 35px;">
                <h3>Related posts</h3>
              </div>
            </div>
          </div>
        </div>

        <div class="row" id="related"></div>

      </div>
      <!--sidebar-->
      <div class="col-md-3">
        <div class="side_bar">
          <div class="side_bar_blog">
            <h4>OWNER INFO</h4>
            <div class="categary">
              <ul>
                <li><img class='img-responsive' id="ownerImage" alt="#"></li>
                <li><a href="#"><b>Name :</b> <label id="ownerName"> recovery</label></a></li>
                <li><a href="#"><b>Surname :</b> <label id="ownerSurname"> recovery</label></a></li>
                <li><a href="#"><b>Phone :</b> <label id="ownerPhone"> recovery</label></a></li>
                <li><a href="#"><b>Email :</b> <label id="ownerEmail"> recovery</label></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
<!-- end section -->

<?php require_once("request_quote.php"); ?>

<script type="text/javascript" src="js/custom/ajaxFunctions.js"></script>
<script type="text/javascript" src="js/custom/detail.js"></script>  
<?php require_once("footer.php"); ?>