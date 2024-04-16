pwdViewLogin = document.getElementById('pwdViewLogin');

function togglePwdViewLogin() {
    var x = document.getElementById("pwdLogin"); 
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
}

pwdViewLogin.addEventListener('change', togglePwdViewLogin);