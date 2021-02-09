var http_request = new XMLHttpRequest();
var postURL = basicURL+"PostMain.php";
document.getElementById("accountLink").classList.add("active");

function makePost(){  
    var title = document.getElementById("title").value;
    var detail = document.getElementById("description").value;
    var category = document.getElementById("category").value;
    var isSeller = document.getElementById("userType").value;
    var isIndividual = document.getElementById("userClass").value;
    var price = document.getElementById("price").value;
    var isPriceNegotiable = document.getElementById("priceType").value;

    var myFile = document.getElementById("adImage");
    var files = myFile.files;
    
    if(title==null || title=="" || detail==null || detail=="" || category==null || category=="" || 
    isSeller==null || isSeller=="" || isIndividual==null || isIndividual=="" || price==null || price=="" || 
    isPriceNegotiable==null || isPriceNegotiable=="" || files.length == 0){
        alert("Please enter all field values.");
    }else{
        if(isSeller == "Seller")
            isSeller = "Y"
        else if(isSeller = "Buyer")
            isSeller = "N"


        if(isIndividual == "Individual")
            isIndividual = "Y"
        else if(isIndividual = "Company")
            isIndividual = "N"


        if(isPriceNegotiable == "Negotiable")
            isPriceNegotiable = "Y"
        else if(isPriceNegotiable = "Non-Negotiable")
            isPriceNegotiable = "N"    

        var file = files[0];
        if (!file.type.match('image.*')){
            alert('The file selected is not an image.');
            return;
        }

        document.getElementById("progressBar").style.display = "block";
        var formData = new FormData();
        formData.append('postInfo',1);
        formData.append('title',title);
        formData.append('detail',detail);
        formData.append('category',category);
        formData.append('price',price);
        formData.append('isSeller',isSeller);
        formData.append('isIndividual',isIndividual);
        formData.append('isPriceNegotiable',isPriceNegotiable);
        formData.append('image',file,file.name);

        http_request.upload.addEventListener("progress", function(event){progressHandler(event)}, false);
        http_request.addEventListener("load", function(event){completeHandler(event)}, false);
        http_request.addEventListener("error", function(event){errorHandler(event)}, false);
        http_request.addEventListener("abort", function(event){abortHandler(event)}, false);
        http_request.open("POST",postURL,true);
        http_request.send(formData);
        loadSaveResponse();
    }
}

function loadSaveResponse(){
    if(ajaxWorks(http_request)){
        http_request.onreadystatechange = function(){
            if (http_request.readyState == 4 ){
                var jsonObj = processJSONResponse(http_request);
                
                alert("Your advert "+jsonObj[0]["Result"]+" posted.");
                window.location.reload();
            }
        }     
    }
}