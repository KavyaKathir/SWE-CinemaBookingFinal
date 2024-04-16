<?php
session_start(); 
var_dump($_SESSION);
$servername = "localhost";
$username = "root"; 
$password = ""; // 
$dbname = "home"; // 

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
$email=$_SESSION['email']; 

$subject = "Your account has been created";
$message = "THANK YOU FOR CREATING AN ACCOUNT WITH US ! Please login to your account to continue booking your movie!

Thank you,
MOVIELANE Accounts Team ";
$sender = "From: MOVIELANE BOOKING";

if(mail($email, $subject, $message, $sender)){
    echo "mail sent";
  
} else {

    $errors['otp-error'] = "Failed while sending code!";
}
?>
