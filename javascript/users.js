const searchBar = document.querySelector(".users .search input"),
searchBtn = document.querySelector(".users .search button"),
userlist = document.querySelector(".users .users-list");

searchBtn.onclick = ()=>{
    searchBar.classList.toggle("active");
    searchBtn.classList.toggle("active");
    searchBar.focus();
    searchBar.value = "";
}

searchBar.onkeyup = ()=>{
    let searchTerm = searchBar.value;
    if(searchTerm != ""){
        searchBar.classList.add("active");
    }
    else{
        searchBar.classList.remove("active");
        searchBtn.classList.toggle("active");
    }
    let xhr = new XMLHttpRequest();
    xhr.open("POST","../php/search.php",true); //get porque estamos a receber e nao a entregar dados
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;                
                userlist.innerHTML = data;
            }
        }
    }
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("searchTerm=" + searchTerm);
}

setInterval(()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("GET","../php/users.php",true); //get porque estamos a receber e nao a entregar dados
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(!searchBar.classList.contains("active")){
                    userlist.innerHTML = data;
                }  
            }
        }
    }
    xhr.send();
},500);  //func loop 500milisegundos