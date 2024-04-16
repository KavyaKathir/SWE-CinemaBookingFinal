
<html>  
<head>  
    <title>Forgot Password</title>  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
</head>
<style>
  .nav {
    display: flex;
            align-items: center;
            padding: 10px 20px;
            background-color: black; 
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); 
        }
       
      
.nav li {
    float: left;
}

.nav li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

.nav li a:hover {
    background-color:red; 
}
.nav img {
            height: 45px;
            width: 350px;
            margin-right: 10px; 
            border: none !important;
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
<?php
session_start();
include_once('connection.php');
if(isset($_REQUEST['pwdrst']))
{
  $email = $_REQUEST['email'];
  $check_email = mysqli_query($connection,"select email from users where email='$email'");
  
  $res = mysqli_num_rows($check_email);
  
  if($res>0)
  {
    $message = '<div>
     <p><b>Hello!</b></p>
     <p>You are recieving this email because we recieved a password reset request for your account.</p>
     <br>
     <p><button class="btn btn-primary"><a href="http://localhost:3000/passwordReset.php">Reset Password</a></button></p>
     <br>
     <p>If you did not request a password reset, no further action is required.</p>
    </div>';
   
include_once("./SMTP/class.phpmailer.php");
include_once("./SMTP/class.smtp.php");
$email = $email; 
$_SESSION['email'] = $email;
$mail = new PHPMailer;
$mail->IsSMTP();
$mail->SMTPAuth = true;                 
$mail->SMTPSecure = "tls";      
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587; 
$mail->Username   =  'mharipriya819@gmail.com';                     //SMTP username
$mail->Password   = 'etcq lypr pjpn ryik';   
$mail->FromName = "MOVIELANE BOOKING";
$mail->AddAddress($email);
$mail->Subject = "Reset Password";
$mail->isHTML( TRUE );
$mail->Body =$message;  
if($mail->send())
{
  
  $msg = "We have e-mailed your password reset link!";
}
}
else
{
 $msg = "We can't find a user with that email address";
}
}

?>
<body>
<nav>
        
        <ul class="nav">
            <li><a href="/Frontend/homepage.php"><img src="/Frontend/img/ml.png" alt="Movie Lane Logo"></a></li>
            <li id="Home" ><a href="/Frontend/homepage.php"> Home</a></li>
            <li id="login" name ="login"><a href="loginn.php">Login</a></li>
        </ul>
        
    </nav>

<div class="container">  
    <div class="table-responsive">  
    <h3 align="center">Forgot Password</h3><br/>
    <div class="box">
     <form id="validate_form" method="post" >  
       <div class="form-group">
       <label for="email">Email Address</label>
       <input type="text" name="email" id="email" placeholder="Enter Email" required 
       data-parsley-type="email" data-parsley-trigg
       er="keyup"  class="form-control" />
      </div>
      <div class="form-group">
       <input type="submit" id="login" name="pwdrst" value="Send Password Reset Link" class="btn btn-success" />
       </div>
       
       <p class="error"><?php if(!empty($msg)){ echo $msg; } ?></p>
     </form>
     </div>
   </div>  
  </div>
</body>
</html>