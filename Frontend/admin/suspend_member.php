<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Manage Users</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
          crossorigin="anonymous">
    <script defer src="https://use.fontawesome.com/releases/v5.0.2/js/all.js"></script>
    <style>
           body {
                   background-color: #f8f9fa;
               }

               .sidebar {
                   height: 100%;
                   width: 250px;
                   position: fixed;
                   top: 0;
                   left: 0;
                   background-color: #343a40;
                   padding-top: 70px;
                   transition: all 0.3s;
                   z-index: 1;
               }

               .sidebar a {
                   padding: 10px 20px;
                   text-decoration: none;
                   font-size: 18px;
                   color: #fff;
                   display: block;
                   transition: all 0.3s;
               }

               .sidebar a:hover {
                   background-color: #555;
               }

               .sidebar .active {
                   background-color: #555;
               }

               .sidebar .nav-item {
                   margin-bottom: 10px;
                   margin-left:25px;
               }

               .sidebar .navbar-brand {
                   font-size: 24px;
                   color: #fff;
                   padding: 20px 0;
                   text-align: center;
                   width: 100%;
                   display: block;
                   position: absolute;
                   top: 0;
                   left: 0;
               }

               .navbar-nav.ml-auto {
                   position: absolute;
                   bottom: 0;
               }

               .container {
                   margin-left: 270px; /* Adjust the margin to prevent overlapping with the sidebar */
                   position: relative;
                  
               }

               form {
                   margin: 50px auto;
                   padding: 20px;
                   background-color: #fff; /* Ensure form background is different from sidebar */
                   border-radius: 5px;
                   box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add shadow for depth */
               }

               .content {
                   margin-left: 290px;
                   padding: 20px;
               }

               /* Add padding to form inputs for better spacing */
               form input[type="text"],
               form input[type="password"] {
                   padding: 10px;
               }

               /* Style form buttons */
               form button[type="submit"] {
                   padding: 10px 20px;
               }

               /* Style form labels for better readability */
               form label {
                   margin-bottom: 5px;
                   display: block;
                   font-weight: bold;
               }</style>
</head>
<body>


<nav class="sidebar">
    <ul>
        <a class="navbar-brand" href="#">
            <img src="/Frontend/img/lo.png" style="width:150px; height:50px;">
            <div class="logo-container"><h1 class="logo">MOVIELANE</h1></div>
        </a>
    </ul>
    <br/>
    <br/>
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="./manageusers.php" class="active">Manage Users</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./schedulemovies.html">Manage Movies</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./managepromotions.php">Manage Promotions</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./manageprices.php">Manage Prices</a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fa fa-user-circle-o"></i> Profile
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fa fa-sign-out"></i> Logout
            </a>
        </li>
    </ul>
</nav>

<div class="content">
    <div class="container-fluid my-container text-center">
        <div class="row justify-content-center">
            <div class="col-md-12 text-center">
                <button id="addBtn" class="btn btn-danger" style="margin-top: 40px; margin-right: 10px;">ADD MEMBER</button>
                <button id="updateBtn" class="btn btn-danger" style="margin-top: 40px; margin-right: 10px;">UPDATE MEMBER</button>
                <button id="deleteBtn" class="btn btn-danger" style="margin-top: 40px; margin-right: 10px;">DELETE MEMBER</button>
                <button id="suspendBtn" class="btn btn-danger" style="margin-top: 40px;">SUSPEND MEMBER</button>
                <br/><br/>
                <br/>
                <br/>
            </div>
        </div>
    </div>
    </div>


<div class="container">
    <h2>Suspend User</h2>
    <form method="post">
        <div class="form-group">
            <label for="user">Select User:</label>
            <select class="form-control" id="user" name="user">
                <option value="">Select User</option>
                <?php
                // Database configuration
                $host = "localhost";
                $username = "root";
                $password = "";
                $dbname = "home";

                // Create connection
                $conn = new mysqli($host, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // SQL to fetch users
                $sql = "SELECT userID, firstName, lastName FROM users";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['userID'] . "'>" . $row['firstName'] . " " . $row['lastName'] . "</option>";
                    }
                }

                $conn->close();
                ?>
            </select>
        </div>
        <button type="submit" name="suspendSubmit" class="btn btn-primary">Suspend User</button>
    </form>
</div>

<?php
// Handle form submission
if(isset($_POST['suspendSubmit'])) {
    // Retrieve selected user ID from the form
    $userID = $_POST['user'];

    // Database configuration
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "home";

    // Create connection
    $conn = new mysqli($host, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL to suspend the user (You can adjust this query based on your database schema)
    $sql = "UPDATE users SET status = 'suspended' WHERE userID = $userID";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('User suspended successfully');</script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}
?>
<script>
        document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("addBtn").addEventListener("click", function() {
        window.location.href = "manageusers.php";

        });
     document.getElementById("updateBtn").addEventListener("click", function() {

                window.location.href = "update_member.php";
            });

        document.getElementById("deleteBtn").addEventListener("click", function() {
     window.location.href = "delete_member.php";


            // You can customize this part to populate the dropdown with the list of members to be deleted
        });

        document.getElementById("suspendBtn").addEventListener("click", function() {
    window.location.href = "manageusers.php";
        });
    });

    </script>
</body>

</html>
