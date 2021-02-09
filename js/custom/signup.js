var http_request = new XMLHttpRequest();
var userURL = basicURL+"UserMain.php";

function submitUserInfo(){
    var name = document.getElementById("name").value;
    var surname = document.getElementById("surname").value;
    var email = document.getElementById("email").value;
    var phone = document.getElementById("phone").value;
    var pass1 = document.getElementById("password1").value;
    var pass2 = document.getElementById("password2").value;
    var myFile = document.getElementById("pic");
    var files = myFile.files;

    if(name==null || name=="" || surname==null || surname=="" || email==null || email=="" 
    || phone==null || phone=="" || pass1==null || pass1=="" || pass2==null || pass2==""
    || files.length == 0){
        alert("Please enter all field values.");
    }else{
        if(pass1 != pass2){
            alert("Passwords must be the same \nPlease check your passwords and try again");
            document.getElementById("password1").value = ""
            document.getElementById("password2").value = "";
        }else if(pass1 == pass2){
            if(pass1.length <= 5){
                alert("Your password is too short.\n Passwords should be more than 5 characters in length.")
            }else{
                document.getElementById("progressBar").style.display = "block";
                var formData = new FormData();
                formData.append('signupInfo',1);
                formData.append('name',name);
                formData.append('surname',surname);
                formData.append('email',email);
                formData.append('phone',phone);
                formData.append('pass1',pass1);

                var file = files[0];
                if (!file.type.match('image.*')){
                    alert('The file selected is not an image.');
                    return;
                }
                formData.append('pic',file,file.name);

                http_request.upload.addEventListener("progress", function(event){progressHandler(event)}, false);
                http_request.addEventListener("load", function(event){completeHandler(event)}, false);
                http_request.addEventListener("error", function(event){errorHandler(event)}, false);
                http_request.addEventListener("abort", function(event){abortHandler(event)}, false);
                http_request.open("POST",userURL, true);
                http_request.send(formData);
                loadSignupResponse();
            }
        }
    }
}

function loadSignupResponse(){
    if(ajaxWorks(http_request)){
        http_request.onreadystatechange = function(){
            if (http_request.readyState == 4 ){
                var jsonObj = processJSONResponse(http_request);
                
                if(jsonObj[0]["Result"] == "done"){
                    alert("Account successfuly created.");
                    window.location.href = "signin.php";
                }else if (jsonObj[0]["Result"] == "failed"){
                    alert("Account could not be created");
                    window.location.reload();
                }else if (jsonObj[0]["Result"] == "same_phone"){
                    alert("Account could not be created.\nAn account with the same phone number alreadly exists.");
                    document.getElementById("progressBar").style.display = "none";
                    document.getElementById("status").style.display = "none";
                    document.getElementById("phone").value = "";
                }
            }
        }
    }
}