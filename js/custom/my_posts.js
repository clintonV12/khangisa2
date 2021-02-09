var http_request = new XMLHttpRequest();
var postURL = basicURL+"PostMain.php";
document.getElementById("accountLink").classList.add("active");

function getInitialData(){
    var formData = new FormData();
    formData.append('allMyPost',1);

    http_request.open("POST",postURL,true);
    http_request.send(formData);
    processData();
}

function processData(){
    if(ajaxWorks(http_request)){
      http_request.onreadystatechange = function(){
        if (http_request.readyState == 4 ){
          var jsonObj = processJSONResponse(http_request);
          showPost(jsonObj);
        }
      }
    }
}
  

function showPost(jsonObj){
  var parent = document.getElementById("postArea");
  if(jsonObj.length == 0){
    parent.innerHTML = "<h3 style='text-align:center;'>No active posts.</h3>"
  }
  for(var i=0; i<jsonObj.length; i++){
      var msg = document.createElement("div");
      msg.className = "blog_section";

      
      var views = 0;
      if(jsonObj[i]["views"] != null)
          views = jsonObj[i]["views"];

      var div2 = document.createElement("div");
      div2.className = "blog_feature_cantant";

      var blog_head = document.createElement("p")
      blog_head.className = "blog_head";
      blog_head.id = "senderName";
      blog_head.innerText = jsonObj[i]["postTitle"];

      var blog_head2 = document.createElement("p")
      blog_head2.className = "blog_head";
      blog_head2.id = "senderName";
      blog_head2.innerHTML = "<small>Category: "+jsonObj[i]["category"]+"</small>";

      div3 = document.createElement("div");
      div3.className = "post_info";

      var list1 = document.createElement("ul");
      var list_item2 = document.createElement("li");
      list_item2.innerHTML = "<i class='fa fa-clock-o' aria-hidden='true'></i> Created on: "+ jsonObj[i]["createDate"];

      var list_item3 = document.createElement("li");
      list_item3.innerHTML = "<i class='fa fa-money' aria-hidden='true'></i> Price: E"+jsonObj[i]["expectedPrice"];
      
      list1.appendChild(list_item2);
      list1.appendChild(list_item3);
      div3.appendChild(list1);

      var content = document.createElement("p");
      content.innerHTML = "<b>Description:</b><br>"+jsonObj[i]["postDetail"];

      div4 = document.createElement("div");
      div4.className = "post_info";

      var list2 = document.createElement("ul");
      
      var list_i1 = document.createElement("li");
      var a1 = document.createElement("a");
      a1.innerHTML = "<i class='fa fa-eye' aria-hidden='true'></i> Views: "+views;
      list_i1.appendChild(a1);

      var list_i2 = document.createElement("li");
      var a2 = document.createElement("a");
      a2.innerHTML = "<i class='fa fa-clock-o' aria-hidden='true'></i> Last view: "+jsonObj[i]["lastViewDate"];
      list_i2.appendChild(a2);

      var list_i3 = document.createElement("li");
      var a3 = document.createElement("a");
      a3.style.cursor = "pointer";
      a3.innerHTML = "<i class='fa fa-trash' aria-hidden='true'></i> delete";
      a3.id = jsonObj[i]["postID"];
      a3.addEventListener("click",function(event){deletePost(event.currentTarget.id)});
      list_i3.appendChild(a3);

      list2.appendChild(list_i1);
      list2.appendChild(list_i2);
      list2.appendChild(list_i3);
      div4.appendChild(list2)

      div2.appendChild(blog_head);
      div2.appendChild(div3);
      div2.appendChild(content);
      div2.appendChild(div4);
      msg.appendChild(div2);

      parent.appendChild(msg);
  }
}


function deletePost(id){
  var formData = new FormData();
  formData.append("delPostID",id);

  http_request.open("POST",postURL,true);
  http_request.send(formData);
  loadDeleteResponse();
}

function loadDeleteResponse(){
  if(ajaxWorks(http_request)){
      http_request.onreadystatechange = function(){
          if (http_request.readyState == 4 ){
              var jsonObj = processJSONResponse(http_request);
              
              alert("Post "+jsonObj[0]["Result"]+" removed");
              window.location.reload();
          }
      }     
  }
}

window.onload = getInitialData();