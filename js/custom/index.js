var http_request = new XMLHttpRequest();
var postURL = basicURL+"PostMain.php";
document.getElementById("homeLink").classList.add("active");

function getInitialData(){
    var formData = new FormData();
    formData.append('allPosts',1);
    formData.append('page',1);

    http_request.open("POST",postURL,true);
    http_request.send(formData);
    processData();
}

function processData(){
  if(ajaxWorks(http_request)){
    http_request.onreadystatechange = function(){
      if (http_request.readyState == 4 ){
        var jsonObj = processJSONResponse(http_request);
      
        showRecentPosts(jsonObj);
        showFeaturedPosts(jsonObj);
      }
    }
  }
}

function showRecentPosts(jsonObj){
    for(var i=0; i<3; i++){
        var id= i+1;
        
        if(jsonObj[i] == null || jsonObj[i] == ""){
          break;
        }
        document.getElementById(id).setAttribute('id',jsonObj[i]["postID"]);
        document.getElementById("img"+id).setAttribute('src',jsonObj[i]["images"][0]);
        document.getElementById("date"+id).innerText = jsonObj[i]["createDate"];
        document.getElementById("title"+id).innerText = jsonObj[i]["postTitle"];
        document.getElementById("desc"+id).innerText = jsonObj[i]["postDetail"].substring(0, 100)+"......";
    }
}

function openDetails(postID){
  window.localStorage.setItem("postID",postID);
  window.location.href = "detail.php";
}

function showFeaturedPosts(jsonObj){
    var parent = document.getElementById("featured");

    for(var i=3; i<15; i++){
      if(jsonObj[i] == null || jsonObj[i] == ""){
        break;
      }
        var div1 = document.createElement("div");
        div1.classList = "col-lg-3 col-md-6 col-sm-6 col-xs-12 margin_bottom_30_all";
        div1.id = jsonObj[i]["postID"];
        div1.style.cursor = "pointer";
        div1.style.margin = "5px";
        div1.style.maxWidth = "280px";
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

function openPostCategory(category){
  window.localStorage.setItem("category",category);
  window.location.href = "posts.php";
}


window.onload = getInitialData();