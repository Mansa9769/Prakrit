function validate(){

    var uname=document.loginform.username
    var upass=document.loginform.password
    var regexp=/^(?=.*[A-Z])(?=.*[0-9])(?=.*[@#_]).+$/


    if (uname.value == "")
        {
            window.alert("Please enter your username.");
            uname.focus();
            return false;
        }
        if (upass.value == "")
            {
                window.alert("Please enter your password.");
                upass.focus();
                return false;
            }
   
    if (upass.value.length < 8){
        window.alert("length of password should be minimum 8 characters.");
        return false;
    }

    if(upass.value.match(regexp)){
        return true;
    }

    if(!upass.value.match(regexp)){
        window.alert("1) The password should have both uppercase and lowercase and number and special symbol. \n 2) Special symbol should be '@','#' or '_' only");
        return false;
    }

}

function validate1(){

    var uname=document.registerform.username
    var upass=document.registerform.password
    var uemail=document.registerform.email

    if (uname.value == "")
        {
            window.alert("Please enter your username.");
            uname.focus();
            return false;
        }

        if(upass.value == ""){
            window.alert("Please enter your password");
            upass.focus();
            return false;

        }

        if(uemail.value == ""){
            window.alert("Please enter your email");
            uemail.focus();
            return false;
        }

        if (upass.value.length < 8){
            window.alert("length of password should be minimum 8 characters.");
            return false;
        }
}



