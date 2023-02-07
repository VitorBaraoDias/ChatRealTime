const form = document.querySelector(".typing-area"),
inputField = document.querySelector(".input-field"),
sendBtn = form.querySelector("button"),
chatBox = document.querySelector(".chat-box");

form.onsubmit = (e)=>{
    e.preventDefault(); //refresh block
}
sendBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST","../php/insert-chat.php",true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                inputField.value = "";
                scrollToBottom();
            }
        }
    }

    //eviar dados via ajax para php 
    let formData = new FormData(form);
    xhr.send(formData);
}

chatBox.onmouseout = ()=>{
    chatBox.classList.add("active");
}
chatBox.onmouseleave = ()=>{
    chatBox.classList.remove("active");
}

setInterval(()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST","../php/get-chat.php",true); //get porque estamos a receber e nao a entregar dados
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                chatBox.innerHTML = data;
                if(!chatBox.classList.contains("active")){ //nao contem active
                    scrollToBottom();
                }
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
},500);  //func loop 500milisegundos

function scrollToBottom(){
    chatBox.scrollTop = chatBox.scrollHeight;
}