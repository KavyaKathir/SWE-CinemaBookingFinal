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
            position: relative;
            z-index: 1; /* Ensure the container appears above the sidebar */
            margin-left: 10px; /* Adjust according to sidebar width */
        }
         .userS {
            position: relative;
            z-index: 1; /* Ensure the container appears above the sidebar */
            margin-left: 520px; /* Adjust according to sidebar width */
        }
        form {
            margin: 50px auto;
            margin-left: 120px;
            padding: 20px;
            background-color: #fff; /* Ensure form background is different from sidebar */
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add shadow for depth */
        }
        .content {
            margin-left: 290px;
            padding: 20px;
        }
        .navbar-nav.ml-auto {
            position: absolute;
            bottom: 0;
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
        }

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
        }
        .sidebar a {
            padding: 10px 20px;
            text-decoration: none;
            font-size: 18px;
            color: white;
            display: block;
            transition: background-color 0.3s;
        }
        .sidebar a:hover {
            background-color: #555;
            color: white;
        }

        .navbar-nav {
            margin-top: 140px; /* Increased top margin to push links down */
        }

        .sidebar .nav-item {
            margin: 0; /* Updated to remove left margin */
            width: 100%; /* Ensures full width */
        }
        .sidebar .navbar-brand {
            font-size: 24px;
            color: #fff;
            padding: 20px 20px; /* Updated padding */
            text-align: center;
            width: 100%; /* Ensures full width */
            display: block;
            position: absolute;
            top: 0;
            left: 0;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
        }
        .hidden {
            display: none;
        }
        .navbar-nav.ml-auto {
            position: absolute;
            bottom: 0;
            width: 100%; /* Ensures full width */
        }
        .btn-manage-movies, .btn-schedule-movies {
            color: #fff;
        }
        .btn-manage-movies:hover, .btn-schedule-movies:hover {
            background-color: #666;
        }
.userS{
margin:50 px auto;}

    </style>
</head>
<body>


<?php
// Establish database connection
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "home";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// If the delete form is submitted
if(isset($_POST['submitDelete'])) {
    $userIdToDelete = $_POST['deleteUser'];

    // SQL to delete user
    $sql = "DELETE FROM users WHERE userID = $userIdToDelete";

    if ($conn->query($sql) === TRUE) {
        echo "User deleted successfully";
    } else {
        echo "Error deleting user: " . $conn->error;
    }
}
?>
<nav class="sidebar">
    <a class="navbar-brand" href="/Frontend/homepage.php">
        <img src="/Frontend/img/lo.png" style="width:150px; height:50px;">
        <h1 class="logo">MOVIELANE</h1>
    </a>
    <ul class="navbar-nav">
        <li class="nav-item"><a href="./manageusers.php">Manage Users</a></li>
        <li class="nav-item"><a href="./schedulemovies.html">Manage Movies</a></li>
        <li class="nav-item"><a href="./managepromotions.php">Manage Promotions</a></li>
        <li class="nav-item"><a href="./manageprices.php">Manage Prices</a></li>
        <li class="nav-item"><a href="#"><i class="fa fa-user-circle-o"></i> Profile</a></li>
        <li class="nav-item"><a href="#"><i class="fa fa-sign-out"></i> Logout</a></li>
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
    <div class="container">
        <form method="post">
            <select id="deleteUser" name="deleteUser">
                <option>Select the User to Delete</option>
                <?php
                // Fetch users from database
                $sql = "SELECT userID, firstName, lastName FROM users where userType=1";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['userID'] . "'>" . $row['firstName'] . " " . $row['lastName'] . "</option>";
                    }
                }
                ?>
            </select>
            <input type="hidden" id="userID" name="userID" value="">
            <button type="submit" name="submitDelete" class="btn btn-danger">Delete User</button>
        </form>
    </div>
</div>

<script>
document.getElementById("deleteUser").addEventListener("change", function() {
            var selectedUserId = this.value;
document.getElementById('userID').value=selectedUserId;
});
</script>
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
        });

        document.getElementById("suspendBtn").addEventListener("click", function() {
            document.getElementById("formContainer").style.display = "none";
            // Show form for suspending members
            document.getElementById("userSelect").style.display = "block";
        });
    });
</script>
</body>
</html>
