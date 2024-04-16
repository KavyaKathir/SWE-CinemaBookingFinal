<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logged Out</title>
    <link rel="stylesheet" href="stylenew.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #333;
            padding: 10px 20px;
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 24px;
            margin: 0;
        }

        .nav-buttons button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            margin-left: 10px;
        }

        .nav-buttons button:hover {
            background-color: #0056b3;
        }

        .container {
            text-align: center;
            margin-top: 50px;
        }

        h1 {
            color: #333;
        }

        p {
            color: #666;
            margin-bottom: 20px;
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="logo-container">
            <h1 class="logo">MOVIELANE</h1>
        </div>
    </div>
    <div class="container">
        <h1>You have been successfully logged out</h1>
        <p>Please click below to log in again or return to homepage.</p>
        
        <button onclick="window.location.href = '/loginn.php';">Login</button>
                
        <?php
        if (isset($_SESSION['userType']) && $_SESSION['userType'] == 2) {
            echo '<button onclick="window.location.href = \'./homepage.php\';">Home</button>';
        } else {

            echo '<button onclick="window.location.href = \'./homepage.php\';">Home</button>';
        }
    ?>
    
        
    
        
    </div>
</body>
</html>
