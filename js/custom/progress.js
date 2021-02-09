function progressHandler(event) {
    var percent = (event.loaded / event.total) * 100;
    document.getElementById("progressBar").value = Math.round(percent);
    document.getElementById("status").innerHTML = Math.round(percent) + "% uploaded... please wait";
}
  
function completeHandler(event) {
    document.getElementById("status").innerHTML = event.target.responseText;
    document.getElementById("progressBar").value = 0; //wil clear progress bar after successful upload
}

function errorHandler(event) {
    document.getElementById("status").innerHTML = "Failed";
}
  
function abortHandler(event) {
    document.getElementById("status").innerHTML = "Aborted";
} 


