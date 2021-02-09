var http_request = new XMLHttpRequest();
var postURL = basicURL+"PostMain.php";
var msgURL = basicURL+"MessageMain.php";

function getInitialData(){
    var post = window.localStorage.getItem("postID");
    var formData = new FormData();
    formData.append('post',post);

    http_request.open("POST",postURL,true);
    http_request.send(formData);
    loadJSON();
}

function loadJSON(){
    if(ajaxWorks(http_request)){
        http_request.onreadystatechange = function(){
            if (http_request.readyState == 4 ){
                var jsonObj = processJSONResponse(http_request);
                
                for(var i=0; i<4; i++){
                    if(jsonObj[i] == null || jsonObj[i] == ""){
                        break;
                    }else if(i == 0){
                        setPostInfo(jsonObj,i);
                    }else{
                        if(jsonObj[i]["postID"] == window.localStorage.getItem("postID")){
                            continue;
                        }else{
                            showFeaturedPosts(jsonObj,i);
                        }
                    }
                }
            }
        }
    }
}

function setPostInfo(jsonObj,i){
    document.getElementById("postImg").src = jsonObj[i]["images"][0];
    document.getElementById("title").innerText = jsonObj[i]["postTitle"];
    document.getElementById("price").innerText = jsonObj[i]["expectedPrice"];
    document.getElementById("date").innerText = jsonObj[i]["createDate"];
    var userType = "";
    if(jsonObj[i]["isSeller"] == "N"){
        userType = "buyer.";
    }else if(jsonObj[i]["isSeller"] == "Y"){
        userType = "seller.";
    }

    if(jsonObj[i]["isIndividual"] == "N"){
        document.getElementById("ut").innerText = "Owner is an individual "+userType;
    }else if(jsonObj[i]["isIndividual"] == "Y"){
        document.getElementById("ut").innerText = "Owner is a company "+userType;
    }

    if(jsonObj[i]["isPriceNegotiable"] == "N"){
        document.getElementById("neg").innerText = "Price is non-negotiable.";
    }else if(jsonObj[i]["isPriceNegotiable"] == "Y"){
        document.getElementById("neg").innerText = "Price is negotiable.";
    }
    
    document.getElementById("desc2").innerText = jsonObj[i]["postDetail"];
    document.getElementsByName("ownerContactBtn")[0].id = jsonObj[i]["user"];

    //set owner info
    
    if(jsonObj[i]["image"] == "" || jsonObj[i]["image"] == null){
        document.getElementById("ownerImage").src = "images/it_service/user.png";
    }else{
        document.getElementById("ownerImage").src = jsonObj[i]["image"];
    }
    
    document.getElementById("ownerName").innerText = jsonObj[i]["name"];
    document.getElementById("ownerSurname").innerText = jsonObj[i]["surname"];
    document.getElementById("ownerPhone").innerText = jsonObj[i]["phone"];
    document.getElementById("ownerEmail").innerText = jsonObj[i]["email"];
    document.getElementById("reviewNum").innerText = jsonObj[i]["reviews"].length;
    document.getElementById("reviewNum2").innerText = jsonObj[i]["reviews"].length;
    document.getElementsByName("saveReview")[0].id = jsonObj[i]["postID"];
    showReviews(jsonObj,i);
}

function showReviews(jsonObj,i){

    for(var j=0; j<jsonObj[i]["reviews"].length; j++){
        var div1 = document.createElement("div");
        div1.classList.add("commant-text","row");
        div1.innerHTML = "<div class='col-lg-2 col-md-2 col-sm-4'>"+
                         "<div class='profile'> <img class='img-responsive' src='"+jsonObj[i]["reviews"][j]["image"]+"' alt='#'> </div>"+
                         "</div>"+
                         "<div class='col-lg-10 col-md-10 col-sm-8'>"+
                         "<h5>"+jsonObj[i]["reviews"][j]["name"]+" "+jsonObj[i]["reviews"][j]["surname"]+"</h5>"+
                         "<p><span class='c_date'>"+jsonObj[i]["reviews"][j]["reviewDate"]+"</span></p><hr>"+
                         "<p class='msg'>"+jsonObj[i]["reviews"][j]["reviewText"]+"</p>"+
                         "</div>";
        document.getElementById("reviewDisplay").appendChild(div1);
    }
}

function sendReview(id){
    var rev = document.getElementById("new-review").value;
    if(rev == null || rev == ""){
        alert("Please enter your review first")
    }else{
        var formData = new FormData();
        formData.append("reviewPost",id);
        formData.append("reviewText",rev);

        http_request.open("POST",postURL,true);
        http_request.send(formData);
        loadReviewResponse();
    }
}

function loadReviewResponse(){
    if(ajaxWorks(http_request)){
        http_request.onreadystatechange = function(){
            if (http_request.readyState == 4 ){
                var jsonObj = processJSONResponse(http_request);
                
                alert("Your review was "+jsonObj[0]["Result"]);
                document.getElementById("new-review").value = "";
            }
        }     
    }
}

function showFeaturedPosts(jsonObj,i){
    var parent = document.getElementById("related");
    
    var div1 = document.createElement("div");
    div1.classList = "col-lg-3 col-md-6 col-sm-6 col-xs-12 margin_bottom_30_all";
    div1.id = jsonObj[i]["postID"];
    div1.style.cursor = "pointer";
    div1.style.margin = "5px";
    div1.style.maxWidth = "250px";
    div1.addEventListener("click",function(event){
        window.localStorage.setItem("postID",event.currentTarget.id);
        window.location.href = "detail.php";
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

function sendOwnerMessage(id){
    var msg = document.getElementById("ownerMsg").value;
    
    if(msg == null || msg == ""){
        alert("Please enter your message first")
    }else{
        var formData = new FormData();
        formData.append("receipent",id);
        formData.append("content",msg);

        http_request.open("POST",msgURL,true);
        http_request.send(formData);
        loadMSGResponse();
    }
}

function loadMSGResponse(){
    if(ajaxWorks(http_request)){
        http_request.onreadystatechange = function(){
            if (http_request.readyState == 4 ){
                var jsonObj = processJSONResponse(http_request);
                
                alert("Your message was "+jsonObj[0]["Result"]);
                document.getElementById("ownerMsg").value = "";
            }
        }     
    }
}

window.onload = getInitialData();
