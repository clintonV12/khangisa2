<div class="section padding_layout_1" style="padding: 50px 0; border-top: solid #000;">
  <div class="container">
    <div class="row">
    
      <div style="border-radius: 25px; outline:none; border:1px solid #17a5e9; width:100%;">
        <input id="searchString" style="font-weight:600; width: 80%; height: 40px; border: none; border-radius: 25px; padding-left:5px;" type="text"
        placeholder="Find the products you want">
        <button style="border-radius: 25px;
        border: none;
        height: 40px;
        width: 100px;
        background-color: #17a5e9;
        float: right;
        width: 20%;
        color: #fff;
        font-weight:600;
        cursor: pointer;
        border: none;" onclick="submitPostSearch()">Search</button>
      </div>

      <div class="col-md-12">
        <div class="full">
          <div class="main_heading text_align_center" style="display: none;" id="sTitle">
            <h2>Search Results</h2>
            <p class="large"></p>
          </div>
        </div>
      </div>
    
    </div>
    <div class="row" id="search_result"></div>
  </div>
</div>

<script type="text/javascript" src="js/custom/ajaxFunctions.js"></script>
<script type="text/javascript">
var searchURL = basicURL+"PostMain.php";

function submitPostSearch(){
  var searchItem = document.getElementById("searchString").value;

  if(searchItem == null || searchItem == ""){
    alert("Please enter something before searching.");
  }else{
    var formData = new FormData();
    formData.append("searchString", document.getElementById("searchString").value);

    http_request.open("POST",searchURL,true);
    http_request.send(formData);
    processSearchData();
  }
}

function processSearchData(){
  if(ajaxWorks(http_request)){
    http_request.onreadystatechange = function(){
      if (http_request.readyState == 4 ){
        var jsonObj = processJSONResponse(http_request);
        showSearchResult(jsonObj);
      }
    }
  }
}

function showSearchResult(jsonObj){
    document.getElementById("sTitle").style.display = "block";
    document.getElementById("search_result").innerHTML = "";
    var parent = document.getElementById("search_result");

    if(jsonObj.length == 0){
      document.getElementById("search_result").innerHTML = "<h3 style='text-align:center'>No results found.</h3>";
    }

    for(var i=0; i<jsonObj.length; i++){
        var div1 = document.createElement("div");
        div1.classList = "col-lg-3 col-md-6 col-sm-6 col-xs-12 margin_bottom_30_all";
        div1.id = jsonObj[i]["postID"];
        div1.style.cursor = "pointer";
        div1.style.margin = "5px";
        div1.style.maxWidth = "300px";
        div1.addEventListener("click",function(event){
          openDetails(event.currentTarget.id);
        });

      div1.innerHTML = 
      "<div class='product_list'>"+
        "<div class='product_img'> <img class='img-responsive' src='"+jsonObj[i]["images"][0]+"' alt=''> </div>"+
        "<div class='product_detail_btm'>"+
          "<div class='center'>"+
            "<h4><a>"+jsonObj[i]["postTitle"]+"</a></h4>"+
          "</div>"+
          "<div class='product_price'>"+
            "<p><span class='new_price'>E"+jsonObj[i]["expectedPrice"]+"</span></p>"+
          "</div><br>"+
          "<div class='starratin'>"+
            "<div class='center' style='color: #039ee3;'><a style='text-align:center;'><i class='fa fa-clock-o' aria-hidden='true'></i> "+jsonObj[i]["createDate"]+"</a></div>"+
          "</div>"+
          "<div class='starratin'>"+
          "<div class='center' style='color:#000;'><a style='text-align:center;'>"+jsonObj[i]["postDetail"].substring(0, 50)+"</a></div>"+
          "</div>"+
        "</div>"+
      "</div>";

      parent.appendChild(div1);
    }
}

</script>