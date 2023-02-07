const passField = document.querySelector(".form .field [type='password']"),
toggleBtn = document.querySelector(".form .field i");

toggleBtn.onclick = ()=>{
    toggleBtn.classList.add("active");
    if(passField.type == "password"){
        return passField.type = "text";
    }
    return passField.type = "password";
} 