var http_request = new XMLHttpRequest();
var accountURL = basicURL+"AccountMain.php";
document.getElementById("accountLink").classList.add("active");

function getAccountInfo(){
    var formData = new FormData();
    formData.append("accountInfo", '1');

    http_request.open("POST",accountURL, true);
    http_request.send(formData);
    setAccountInfo();
}

function setAccountInfo(){
    if(ajaxWorks(http_request)){
        http_request.onreadystatechange = function(){
            if (http_request.readyState == 4 ){
                var jsonObj = processJSONResponse(http_request);

                document.getElementById("numPosts").innerText = jsonObj[0]["numPost"];
                document.getElementById("numMsg").innerText = jsonObj[0]["numMsg"]; 
                document.getElementById("userEmail").value = jsonObj[0]["email"];
                document.getElementById("email").innerText = jsonObj[0]["email"];
                document.getElementById("userPhone").value = jsonObj[0]["phone"];
                document.getElementById("userName").innerText = jsonObj[0]["name"];
                document.getElementById("userName2").value = jsonObj[0]["name"];
                document.getElementById("userSurname").value = jsonObj[0]["surname"];  
                document.getElementById("userImage").setAttribute("src",jsonObj[0]["image"]);              
            }
        }
    }
}

function updateProfile(){
    var name = document.getElementById("userName2").value;
    var surname = document.getElementById("userSurname").value;
    var email = document.getElementById("userEmail").value;
    var phone = document.getElementById("userPhone").value;
    
    if(name==null || name=="" || surname==null || surname=="" || email==null || email=="" || phone==null || phone=="" ){
        alert("Please enter all field values.");
    }else{
        var formData = new FormData();
        formData.append("name",name);
        formData.append("surname",surname);
        formData.append("email",email);
        formData.append("phone",phone);

        var myFile = document.getElementById("userNewImage");
        var files = myFile.files;
        
        if(files.length > 0){
            var file = files[0];
            if (!file.type.match('image.*')){
                alert('The file selected is not an image.');
                return;
            }
            formData.append('pic',file,file.name);
            formData.append('imageAvail','1');
        }else{
            formData.append('imageAvail','0');
        }

        http_request.open("POST",accountURL, true);
        http_request.send(formData);
        getResponse();
    }
}

function getResponse(){
    if(ajaxWorks(http_request)){
        http_request.onreadystatechange = function(){
            if (http_request.readyState == 4 ){
                var jsonObj = processJSONResponse(http_request);
                
                alert("Profile "+jsonObj[0]["Result"]+" updated");
                window.location.reload();
            }
        }     
    }
}

function updatePassword(){
    var pass1 = document.getElementById("pass1").value;
    var pass2 = document.getElementById("pass2").value;
    var pass3 = document.getElementById("pass3").value;

    if(pass1==null || pass1=="" || pass2==null || pass2=="" || pass3==null || pass3==""){
        alert("Please enter all field values.");
    }else{
        if(pass2 != pass3){
            alert("Passwords must be the same \nPlease check your passwords and try again");
            document.getElementById("pass2").value = ""
            document.getElementById("pass3").value = "";
        }else if(pass2 == pass3){
            if(pass2.length <= 5){
                alert("Your password is too short.\n Passwords should be more than 5 characters in length.")
            }else{
                var formData = new FormData();
                formData.append('currentPassword',pass1);
                formData.append('newPassword',pass2);

                http_request.open("POST",accountURL, true);
                http_request.send(formData);
                getPasswordResponse();
            }
        }
    }
}

function getPasswordResponse(){
    if(ajaxWorks(http_request)){
        http_request.onreadystatechange = function(){
            if (http_request.readyState == 4 ){
                var jsonObj = processJSONResponse(http_request);
                
                alert("Password "+jsonObj[0]["Result"]+" updated");
                window.location.reload();
            }
        }     
    }
}

window.onload = getAccountInfo();