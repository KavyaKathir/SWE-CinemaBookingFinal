<?php
session_start();
// Database connection details
$host = "localhost";
$dbname = "home";
$username = "root";
$password = "";

try {
    // Create a new PDO instance
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit(); // Exit script if connection fails
}

if(isset($_POST['submit'])) {
  $email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
    $pwd = $_POST['pwd'];
    $cpwd = $_POST['cpwd'];

    if($pwd == $cpwd) {
        $hashed_password = password_hash($pwd, PASSWORD_DEFAULT);
        echo "Hashed Password: " . $hashed_password . "<br>";
        echo "Email: " . $email . "<br>";
        try {
            // Prepare and execute the update query
            $stmt = $conn->prepare("UPDATE users SET password = :hashed_password WHERE email = :email");
            $stmt->bindParam(':hashed_password', $hashed_password);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            
            // Check if any rows were affected
            $affected_rows = $stmt->rowCount();
            
            if($affected_rows > 0) {
                $msg = 'Your password updated successfully <a href="/loginn.php">Click here</a> to login';
            } else {
                $msg = "Error while updating password.";
            }
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        $msg = "Password and Confirm Password do not match";
    }
}
?>

<html>
<head>
    <title>Password Reset</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
</head>
<style>
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
 .box
 {
  width:100%;
  max-width:600px;
  background-color:#f9f9f9;
  border:1px solid #ccc;
  border-radius:5px;
  padding:16px;
  margin:0 auto;
 }
 input.parsley-success,
 select.parsley-success,
 textarea.parsley-success {
   color: #468847;
   background-color: #DFF0D8;
   border: 1px solid #D6E9C6;
 }

 input.parsley-error,
 select.parsley-error,
 textarea.parsley-error {
   color: #B94A48;
   background-color: #F2DEDE;
   border: 1px solid #EED3D7;
 }

 .parsley-errors-list {
   margin: 2px 0 3px;
   padding: 0;
   list-style-type: none;
   font-size: 0.9em;
   line-height: 0.9em;
   opacity: 0;

   transition: all .3s ease-in;
   -o-transition: all .3s ease-in;
   -moz-transition: all .3s ease-in;
   -webkit-transition: all .3s ease-in;
 }

 .parsley-errors-list.filled {
   opacity: 1;
 }

 .parsley-type, .parsley-required, .parsley-equalto{
  color:#ff0000;
 }
.error
{
  color: red;
  font-weight: 700;
}
</style>

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
    <div class="table-responsive">
    <h3 text-align="center">Reset Password</h3><br/>
    <div class="box">
    <form id="validate_form" method="post">
    <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>"/>
    <div class="form-group">
        <label for="pwd">Password</label>
        <input type="password" name="pwd" id="pwd" placeholder="Enter Password" required class="form-control"/>
    </div>
    <div class="form-group">
        <label for="cpwd">Confirm Password</label>
        <input type="password" name="cpwd" id="cpwd" placeholder="Enter Confirm Password" required class="form-control"/>
    </div>
    <div class="form-group">
        <input type="submit" id="login" name="submit" value="Reset Password" class="btn btn-success" />
    </div>
    <p class="error"><?php if(!empty($msg)){ echo $msg; } ?></p>
</form>
     </div>
   </div>
  </div>

</body>
</html>
