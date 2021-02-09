var basicURL = "http://127.0.0.1/khangisa2/Backend/"; 

function processJSONResponse(http_request){
    var jsonObj = null;
    //try{
        const arr1 = http_request.responseText;
        jsonObj = JSON.parse(arr1);/*
    }catch(error){
        txt="There was an error on this page.\n\n";
        txt+="Error message: " + error.message + "\n\n";
        txt+="Click OK to continue.\n\n";
        alert(txt);
    }*/

    return jsonObj;
}

function ajaxWorks(http_request){
    try{
        // Opera 8.0+, Firefox, Chrome, Safari
        http_request = new XMLHttpRequest();
        return true;
    }catch (e){
        // Internet Explorer Browsers
        try{
            http_request = new ActiveXObject("Msxml2.XMLHTTP");
            return true;
        }
        catch (e) {
            try{
                http_request = new ActiveXObject("Microsoft.XMLHTTP");
                return true;
            }
            catch (e){
                // Something went wrong
                alert("Your browser broke!");
                return false;
            }
        }
    }
}
