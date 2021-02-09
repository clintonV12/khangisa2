//variable used by pagination
var numResultsOnPage = 15;
var totalPages = 0;
var page;

function pagination(){
    document.getElementById("pager").innerHTML = "";

    if(page == null && isNaN(page)){
        page = 1;
    }

    if(Math.ceil(totalPages/numResultsOnPage) > 0){
        var list = document.createElement("ul");
        list.className = "pagination";
        document.getElementById("pager").appendChild(list);
        
        if(page > 1){    
            var listItem = document.createElement("li");
            listItem.className = "prev";
        
            var link = document.createElement("a");
            link.innerText = "Prev";
            link.addEventListener('click',function(){
                page = page-1; 
                pagination();
                getInitialData();
            });
        
            listItem.appendChild(link);
            list.appendChild(listItem);
        }
        
        if(page > 3){
            var listItem = document.createElement("li");
            listItem.className = "start";
        
            var dots = document.createElement("li");
            dots.className = "dots";
            dots.innerText = "..."
        
            var link = document.createElement("a");
            link.innerText = "1";
            link.addEventListener('click',function(){
                page = 1; 
                pagination();
                getInitialData();
            });
        
            listItem.appendChild(link);

            list.appendChild(listItem);
            list.appendChild(dots);
        }
        
        if(page-2 > 0){
            var listItem = document.createElement("li");
            listItem.className = "page";
        
            var link = document.createElement("a");
            link.innerText = page-2;
            link.addEventListener('click',function(){
                page = page-2; 
                pagination();
                getInitialData();
            });
        
            listItem.appendChild(link);
            list.appendChild(listItem);
        }
        
        if(page-1 > 0){
            var listItem = document.createElement("li");
            listItem.className = "page";
        
            var link = document.createElement("a");
            link.innerText = page-1;
            link.addEventListener('click',function(){
                page = page-1; 
                pagination();
                getInitialData();
            });
        
            listItem.appendChild(link);
            list.appendChild(listItem);
        }
        
        var listItem = document.createElement("li");
        listItem.className = "currentpage";
        
        var link = document.createElement("a");
        link.innerText = page;
        link.addEventListener('click',function(){
            page = page; 
            pagination();});
        
        listItem.appendChild(link);
        list.appendChild(listItem);
        
        if(page+1 < Math.ceil(totalPages/numResultsOnPage)+1){
            var listItem = document.createElement("li");
            listItem.className = "page";
            
            var link = document.createElement("a");
            link.innerText = page+1;
            link.addEventListener('click',function(){
                page = page+1; 
                pagination();
                getInitialData();
            });
            
            listItem.appendChild(link);   
            list.appendChild(listItem); 
        }
        
        if(page+2 < Math.ceil(totalPages/numResultsOnPage)+1){
            var listItem = document.createElement("li");
            listItem.className = "page";
            
            var link = document.createElement("a");
            link.innerText = page+2;
            link.addEventListener('click',function(){
                page = page+2; 
                pagination();
                getInitialData();
            });
            
            listItem.appendChild(link);   
            list.appendChild(listItem); 
        }
        
        if(page < Math.ceil(totalPages/numResultsOnPage)-2){
            var listItem = document.createElement("li");
            listItem.className = "end";
        
            var dots = document.createElement("li");
            dots.className = "dots";
            dots.innerText = "...";
            
            var link = document.createElement("a");
            link.innerText = Math.ceil(totalPages/numResultsOnPage);
            link.addEventListener('click',function(){
                page = Math.ceil(totalPages/numResultsOnPage); 
                pagination();
                getInitialData();
            });
        
            listItem.appendChild(link);

            list.appendChild(dots);
            list.appendChild(listItem);  
        }
        
        if(page < Math.ceil(totalPages/numResultsOnPage)){
            var listItem = document.createElement("li");
            listItem.className = "next";
        
            var link = document.createElement("a");
            link.innerText = "Next";
            link.addEventListener('click',function(){
                page = page+1; 
                pagination();
                getInitialData();
            });
        
            listItem.appendChild(link);
        
            list.appendChild(listItem);
        }   
    }
    return page; 
}