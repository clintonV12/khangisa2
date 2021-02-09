var http_request = new XMLHttpRequest();
var loginURL = basicURL+"AuthenticationMain.php";

function sendLogin(){
    var usr = document.getElementById("username").value;
    var pass = document.getElementById("password").value;

    if(usr == null || usr == "" || pass == null || pass == ""){
        alert("Please enter your login credentials first");
    }else{
        var formData = new FormData();
        formData.append('username',usr);
        formData.append('password',pass);

        http_request.open("POST",loginURL, true);
        http_request.send(formData);
        loadJSON();
    }
}

function loadJSON(){
    if(ajaxWorks(http_request)){
        http_request.onreadystatechange = function(){
            if (http_request.readyState == 4 ){
                var jsonObj = processJSONResponse(http_request);
                                
                if(jsonObj[0]['answer'] == "login successful"){
                    window.location.href = "my_account.php";
                }
                else if(jsonObj[0]['answer'] == "login failed"){
                    alert("Sorry, your login credentials are incorrect.");
                    document.getElementById("username").value = "";
                    document.getElementById("password").value = "";
                }
            }
        }
    }
}