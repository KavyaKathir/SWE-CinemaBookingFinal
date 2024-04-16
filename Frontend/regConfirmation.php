<?php
session_start();

$dsn = 'mysql:host=localhost;dbname=home';
$username = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query("SELECT accountID FROM users ORDER BY userID DESC LIMIT 1");
    $account_id = $stmt->fetchColumn();
    $stmt1 = $pdo->query("SELECT email FROM users ORDER BY userID DESC LIMIT 1");
    $email = $stmt1->fetchColumn();
    $stmt2 = $pdo->query("SELECT firstname FROM users ORDER BY userID DESC LIMIT 1");
    $firstname = $stmt2->fetchColumn();
    $subject = "Your MOVIELANE account has been created";
$message = "Hi $firstname,

THANK YOU FOR CREATING AN ACCOUNT WITH US !
<br/> 
Please login to your account to continue booking your movie!

Thank you,
MOVIELANE Accounts TEAM";

$sender = "From: MOVIELANE BOOKING";

if(mail($email, $subject, $message, $sender)){
   
} else {
    
    echo "Failed to send an email! ";
}
    
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;500;700;800&family=Sen:wght@700&display=swap" rel="stylesheet">
    <title>Registration Confirmation</title>
    <script src="https://kit.fontawesome.com/dc49a974a4.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        .title {
            font-size: 50px;
            font-family: "Apple Chancery", Times, serif;
        }

        .headerDiv {
            border-bottom: 5px solid black;
            margin-top: 0;
            margin-left: 0;
            margin-right: 0;
            background-color: lightgray
        }

        .normalText {
            text-align: center;
            font-size: 25px;
        }

        .subTitle {
            text-align: center;
            font-size: 40px;
        }
        .navbar {
            width: 100%;
            height: 50px;
            background-color: black;
            margin-bottom: 0;
        }

        .navbar-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 50px;
            height: 100%;
            color: white;
            font-family: 'Sen', sans-serif;
        }

        .logo-container {
            display: flex;
            align-items: center;
            
        }

        .logo {
    font-style: 30px;
    color: greenyellow;
    cursor: default;
    transition: 1s ease;
    font-weight: bold;
}

        .logo img {
            width: 150px;
            height: 10px;
            
        }
        .button-container {
            text-align: center;
        }
        .button {
            
            color: red; 
            background-color: #fff; 
            border: 2px solid red; 
            padding: 10px 20px; 
            border-radius: 5px; 
            text-decoration: none; 
            cursor: pointer; 
            transition: background-color 0.3s ease; 
        }

        
        .button:hover {
            background-color: red; 
            color: #fff; 
        }
    </style>

</head>
<body>
<div class="background-animation"></div>
<div class="navbar">
        <div class="navbar-container">
            <div class="logo-container">
                <img src="/Frontend/img/lo.png" alt="Logo" style="width: 100px; height:45px;" class="logo">
                <h1 class="logo">MOVIELANE</h1>
            </div>
           
        </div>
    </div>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
<p class="subTitle">Account Verified!</p>
<p class="normalText" style="margin-left: 80px; margin-right: 80px;">Congratulations! Your account has been successfully created. Your account ID is: <?php  echo $account_id;  ?></p>
<br/>
<p class="normalText">Please login to your account!</p>
<br/>
<div class="button-container">

    <button class="button" onclick="location.href='/loginn.php';">Login</button>
    </div>
   
 
<br>
<br>
<p class="normalText">Confirmation email has been sent to your email. Please check !</p>

<br/>
<br/>
<br/>

<p class="normalText">Return to homepage? <button class="button" onclick="location.href='homepage.php';">Home</button></p>

</body>

</html>
