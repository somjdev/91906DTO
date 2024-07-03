function showLogin(){
    var loginPopup = document.getElementById("loginBackground");
    if (loginPopup.style.display == "none"){
        loginPopup.style.display = "show"
    }
    else{
        loginPopup.style.display = "none"
    }
    return false;
}