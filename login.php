<?php

session_start();

if(isset($_POST['login'])) {
    
    $email = $_POST['email'];
    $password = $_POST['password'];
    $rememberMe = isset($_POST['remember']) ? true : false;
    // Connect to your database - replace with your actual database credentials
    $username = "root";
    $password_db = "";
    $database = "home";

    try {$conn = new PDO("mysql:host=localhost;dbname=$database", $username, $password_db);    
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        if ($stmt->rowCount() == 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row['status'] == 'suspended') {
                // User is suspended, show an alert and redirect to login page
                echo '<script>alert("Your account is suspended. Please contact MOVIELANE Tech support team for assistance.");</script>';
                
            }
        else {    
            if (password_verify($password, $row['password'])) {
                
                $_SESSION['email'] = $email;
                $_SESSION['userType'] = $row['userType']; 
                echo $_SESSION['userType'];
                $setactive = "UPDATE users SET status = 1 WHERE userID = :userID";
$stmt = $conn->prepare($setactive);
$stmt->bindParam(':userID', $row['userID'], PDO::PARAM_INT); 
$stmt->execute();
                if ($_SESSION['userType'] == 1) {
                    $_SESSION['user_id']=$row['userID'];   
                    header('Location: /Frontend/managemovies.php');
                    exit();
                } 
                else
                {
                    $_SESSION['user_id']=$row['userID'];
                    
                    header('Location: /Frontend/homepage.php');
                    exit();
                }
            } else {
            $_SESSION['error'] = "Incorrect password!";
            header('Location: /loginn.php');
            exit();
        }
     } }else {
        $_SESSION['error'] = "User not found!";
        header('Location: ./loginn.php');
        exit();
    }

}
  
     catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    $conn = null;
    if ($rememberMe) {
        
        
        setcookie('email', $email, time() + 10);
                    echo $_COOKIE['email'];
        
                  header("Location: logout.php");
                  exit();
        }
}

if(isset($_POST['forgetPassword'])) {
    
    echo "Forget password functionality triggered!";
}
?>
