<?php require_once "creaAccount.php"; ?>
<?php
require_once "connection.php";?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Email Verification</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
html,body{
    background: #6665ee;
    font-family: 'Poppins', sans-serif;
}
::selection{
    color: #fff;
    background: #6665ee;
}
.container{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
.container .form{
    background: #fff;
    padding: 30px 35px;
    border-radius: 5px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
.container .form form .form-control{
    height: 40px;
    font-size: 15px;
}
.container .form form .forget-pass{
    margin: -15px 0 15px 0;
}
.container .form form .forget-pass a{
   font-size: 15px;
}
.container .form form .button{
    background: #6665ee;
    color: #fff;
    font-size: 17px;
    font-weight: 500;
    transition: all 0.3s ease;
}
.container .form form .button:hover{
    background: #5757d1;
}
.container .form form .link{
    padding: 5px 0;
}
.container .form form .link a{
    color: #6665ee;
}
.container .login-form form p{
    font-size: 14px;
}
.container .row .alert{
    font-size: 14px;
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
        </style>
</head>
<body>
<div class="navbar">
        <div class="navbar-container">
            <div class="logo-container">
                <img src="/Frontend/img/lo.png" alt="Logo" style="width: 100px; height:45px;" class="logo">
                <h1 class="logo">MOVIELANE</h1>
            </div>
            
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="user-otp.php" method="POST" autocomplete="off">
                    <h2 class="text-center">Verify your email!</h2>
                    <?php
                    if(isset($_SESSION['info'])){
                        ?>
                        <div class="alert alert-success text-center">
                            <?php echo $_SESSION['info']; ?>
                        </div>
                        <?php
                    }
                    ?>
                    
                    <div class="form-group">
                        <input class="form-control" type="number" name="otp" placeholder="Enter verification code" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="check" value="Submit">
                    </div>
                </form>
  <?php   
  $dsn = 'mysql:host=localhost;dbname=home';
  $username = 'root';
  $password = '';
  
 
      $pdo = new PDO($dsn, $username, $password);
     
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  if(isset($_POST['check'])){
    $_SESSION['info'] = "";
    $otp_code = $_POST['otp'];
    
    $check_code_query = "SELECT * FROM users WHERE code = :otp_code";
    $stmt = $pdo->prepare($check_code_query);
    $stmt->bindParam(':otp_code', $otp_code);
    $stmt->execute();
    
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if($row){
        
        
            $_SESSION['name'] = $name; 
            $_SESSION['email'] = $email;
            

            header('location: /Frontend/regConfirmation.php');
            exit();
        }
    else {
        $errors['otp-error'] = "You've entered incorrect code! Please check again! ";
        echo $errors['otp-error'];
    }
    
}

?>
            </div>
        </div>
    </div>

</body>
</html>