var http_request = new XMLHttpRequest();
var msgURL = basicURL+"MessageMain.php";
document.getElementById("accountLink").classList.add("active");

function getInitialData(){
    var formData = new FormData();
    formData.append('allMyMsg',1);

    http_request.open("POST",msgURL,true);
    http_request.send(formData);
    processData();
}

function processData(){
    if(ajaxWorks(http_request)){
      http_request.onreadystatechange = function(){
        if (http_request.readyState == 4 ){
          var jsonObj = processJSONResponse(http_request);
          showMessage(jsonObj);
        }
      }
    }
}
  
function showMessage(jsonObj){
    var parent = document.getElementById("msgArea");
    if(jsonObj.length == 0){
      parent.innerHTML = "<h3 style='text-align:center;'>No messages.</h3>"
    }
    for(var i=0; i<jsonObj.length; i++){
        var msg = document.createElement("div");
        msg.className = "blog_section";

        var div2 = document.createElement("div");
        div2.className = "blog_feature_cantant";

        var blog_head = document.createElement("p")
        blog_head.className = "blog_head";
        blog_head.id = "senderName";
        blog_head.innerText = jsonObj[i]["name"]+" "+jsonObj[i]["surname"];

        div3 = document.createElement("div");
        div3.className = "post_info";

        var list1 = document.createElement("ul");
        var list_item1 = document.createElement("li");
        list_item1.innerHTML = "<b>Sender contact:</b>";

        var list_item2 = document.createElement("li");
        list_item2.innerHTML = "<i class='fa fa-envelope' aria-hidden='true'></i> "+ jsonObj[i]["email"];

        var list_item3 = document.createElement("li");
        list_item3.innerHTML = "<i class='fa fa-phone' aria-hidden='true'></i> (+268) "+ jsonObj[i]["phone"];
        
        list1.appendChild(list_item1);
        list1.appendChild(list_item2);
        list1.appendChild(list_item3);
        div3.appendChild(list1);

        var content = document.createElement("p");
        content.innerText = jsonObj[i]["content"];

        var list2 = document.createElement("ul");
        
        var list_i1 = document.createElement("li");
        var a1 = document.createElement("a");
        a1.style.cursor = "pointer";
        a1.setAttribute("name",jsonObj[i]["messageID"]);
        a1.setAttribute("data-toggle","collapse");
        a1.setAttribute("href","#msgCollapse");
        a1.setAttribute("role","button");
        a1.setAttribute("aria-expanded","false");
        a1.setAttribute("aria-controls","collapseExample");
        a1.innerHTML = "<i class='fa fa-reply' aria-hidden='true'></i> reply";
        list_i1.appendChild(a1);

        //message collapse box
        var full = document.createElement("div"); full.className = "full";
        full.style.marginTop = "20px";
        var msgCollapse = document.createElement("div"); msgCollapse.id = "msgCollapse";
        msgCollapse.classList.add("full","collapse","commant_box");
        var form = document.createElement("form");
        var textArea = document.createElement("textarea");
        textArea.classList.add("form-control","animated");
        textArea.setAttribute("cols","40");
        textArea.setAttribute("id","msg");
        textArea.setAttribute("placeholder","Enter your reply here...");
        textArea.setAttribute("required","true");
        
        var full_bt = document.createElement("div");
        full_bt.classList.add("full_bt","center");
        var btn = document.createElement("button");
        btn.classList.add("btn","sqaure_bt");
        btn.innerText = "send";
        btn.id = jsonObj[i]["senderID"]
        btn.addEventListener("click",function(event){
          sendReply(event.currentTarget.id);
        });
        full_bt.appendChild(btn);

        form.appendChild(textArea);
        form.appendChild(full_bt);
        msgCollapse.appendChild(form);
        full.appendChild(msgCollapse);
        //end message collapse box
        list_i1.appendChild(full);


        var list_i2 = document.createElement("li");
        var a2 = document.createElement("a");
        a2.style.cursor = "pointer";
        a2.setAttribute("id",jsonObj[i]["messageID"]);
        a2.innerHTML = "<i class='fa fa-trash' aria-hidden='true'></i> delete";
        a2.addEventListener("click",function(event){
          deleteMessage(event.currentTarget.id);
        });
        list_i2.appendChild(a2);

        list2.appendChild(list_i1);
        list2.appendChild(list_i2);

        div2.appendChild(blog_head);
        div2.appendChild(div3);
        div2.appendChild(content);
        div2.appendChild(list2);
        msg.appendChild(div2);

        parent.appendChild(msg);
    }
}

function deleteMessage(id){
  var formData = new FormData();
  formData.append("messageID",id);

  http_request.open("POST",msgURL,true);
  http_request.send(formData);
  loadDeleteResponse();
}

function loadDeleteResponse(){
  if(ajaxWorks(http_request)){
      http_request.onreadystatechange = function(){
          if (http_request.readyState == 4 ){
              var jsonObj = processJSONResponse(http_request);
              
              alert("Message "+jsonObj[0]["Result"]+" removed");
              window.location.reload();
          }
      }     
  }
}

function sendReply(id){
  
  var formData = new FormData();
  formData.append("replyMsg",document.getElementById("msg").value);
  formData.append("replyReceiver",id);

  http_request.open("POST",msgURL,true);
  http_request.send(formData);
  loadMSGResponse();
}

function loadMSGResponse(){
  if(ajaxWorks(http_request)){
      http_request.onreadystatechange = function(){
          if (http_request.readyState == 4 ){
              var jsonObj = processJSONResponse(http_request);
              
              alert("Your message was "+jsonObj[0]["Result"]);
              window.location.reload();
          }
      }     
  }
}

window.onload = getInitialData();