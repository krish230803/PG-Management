// ? For Email Valid Or Invalid
function validation() {
    var email = document.getElementById("email-field");
    var pattern = /^[a-z\._\-0-9]*[@][a-z]*[\.][a-z]{2,4}$/;
    var form = document.getElementById("form");
    var emailError = document.getElementById("email-error");

    if (email.value.match(pattern)) {
        form.classList.add("valid");
        form.classList.remove("invalid");
        emailError.innerHTML = "valid email";
        email.style.borderBottom = "2px solid green"; // Change border color to green
        emailError.style.color = "green";
    } else {
        form.classList.remove("valid");
        form.classList.add("invalid");
        emailError.innerHTML = "Please Enter a valid email";
        email.style.borderBottom = "2px solid red"; // Change border color to red
        emailError.style.color = "red";
    }  
}
//? For Password Validation

function passwordvalidation(){

    var password = document.getElementById("password");
    var passpattern = '(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{8,})';
    var passError = document.getElementById("password-error");
   

    if(password.value.match(passpattern)){
        passError.innerHTML = "Valid Password";
        password.style.borderBottom = "2px solid green";
        passError.style.color = "green";
    }
    else{
        passError.innerHTML = "Password  atleast 8 charater, must contain 1uppercase,1lowercase,1number and 1symbol";
        password.style.borderBottom = "2px solid red";
        passError.style.color = "red";
    }
    
}
//? For Password Match

function password1validation() {
    var password = document.getElementById("password");
    var password1 = document.getElementById("password1");
    var pass1Error = document.getElementById("password1-error");

    if (password.value === password1.value) {
        pass1Error.innerHTML = "Password Match";
        password1.style.borderBottom = "2px solid green";
        pass1Error.style.color = "green";
    } else {
        pass1Error.innerHTML = "Password Doesn't match";
        password1.style.borderBottom = "2px solid red";
        pass1Error.style.color = "red";
    }
}


// ? For Password Hide Or Unhide
var a;
function pass(){
    if(a==1){
        document.getElementById('password').type='password';
        document.getElementById('pass-icon').src='eye-off.svg';
        a=0;
    }
   else{
    document.getElementById('password').type='text';
        document.getElementById('pass-icon').src='eye.svg';
        a=1;
   } 
}
//? For Confirm password
    var b;
    function pass1(){
    if(b==1){
        document.getElementById('password1').type='password';
        document.getElementById('pass-icon1').src='eye-off.svg';
        b=0;
    }
   else{
    document.getElementById('password1').type='text';
        document.getElementById('pass-icon1').src='eye.svg';
        b=1;
   }
}
        
// ? For ALert 
function fun() {
    var name = document.getElementById("name");
    var email = document.getElementById("email-field");
    var password = document.getElementById("password");
    var password1 = document.getElementById("password1");
    var pattern = /^[a-z\._\-0-9]*[@][a-z]*[\.][a-z]{2,4}$/;
    var passpattern = '(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{8,})';
    
    if (email.value.match(pattern) && password.value === password1.value && password.value.match(passpattern) && name.value !== '') {
        alert('Account Created Successfully');
        return true;
    } else {
        // Prevent form submission and show alert
        alert('Please Fill valid Details!');
        return false;
    }
}
