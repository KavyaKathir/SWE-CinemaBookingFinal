<?php
   require("./login.php");


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="style.css">
    <style>
 .navbar {
    background-color: black;
    color: greenyellow;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.navbar-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px;
}

.logo {
    width: 100px;
    height: 45px;
    margin-right: 20px;
    line-height: 55px; /* Adjust this value to move the title down */
}


.logo-container {
    display: flex;
    align-items: center;
    padding-top: 5px; /* Adjust this value to move the title down */
}


.nav {
    list-style-type: none;
    margin: 0;
    padding: 0;
    display: flex;
    align-items: center;
}

.nav li {
    margin: 0 10px; 
}

.nav li:first-child {
    margin-left: 0; 
}

.nav li:last-child {
    margin-right: 0;
}

.nav li a {
    color: white;
    text-decoration: none;
    padding: 10px;
}

.nav li a:hover {
    background-color: red;
}
        .h1{color:brown;}
        .error-message {
            text-align: center;
            font-size: 24px;
            color: red;
            margin-top: 20px; 
        }
        .forget-password-link {
            color: blue;
            text-decoration: underline;
            cursor: pointer;
        }
        #submitLogin {
        width: 630px; 
    background-color: red;    
    }

    </style>
   
</head>
<body>
<nav class="navbar">
    <div class="navbar-container">
        <div class="logo-container">
            <img src="/Frontend/img/lo.png" alt="Logo" style="width: 100px; height:50px;" class="logo">
            <h1 style="width: 100px; height:50px;" class="logo">MOVIELANE</h1>
        </div>
        <ul class="nav">
            <li><a href="/Frontend/homepage.php">Home</a></li>
            <li><a href="/Frontend/search.html">Browse Movies</a></li>
           
        </ul>
    </div>
</nav>

    <form class="login" method="post" action="../login.php">
        <h1> Login </h1>

        <label for="emailLogin">Email: </label>
        <input type="email" id="emailLogin" name="email" placeholder="firstlast@gmail.com">

        <label for="pwdLogin">Password: </label>

        <input type="password" id="pwdLogin" name="password">
        <input type="checkbox" id="pwdViewLogin">Show Password


        <br/> <br/>
        <label for="forgotpassword"><a href="forgot.php">Forgot password?</a></label>
        
        <br/> <br/>
        <input type="checkbox" id="remember" name="remember">  <label for="remember">Remember Me</label> 

        <input type="submit" id="submitLogin" name="login" value="Login">
        <?php
        
        
        if (isset($_SESSION['error'])) {
            echo '<div class="error-message">' . $_SESSION['error'] . '</div>';
            unset($_SESSION['error']);
        }
        ?>
       
    </form>

    <div class="signin">
        <p>Don't have an account? <a href="creaAccount.html">Create Account</a></p>
    </div>

    <script src="login.js"></script>
</body>
</html>
