var http_request = new XMLHttpRequest();
var logoutURL = basicURL+"AuthenticationMain.php";

function sendLogoutRequest(){
    var formData = new FormData();
    formData.append('logout','1');

    http_request.open("POST",logoutURL, true);
    http_request.send(formData);
}