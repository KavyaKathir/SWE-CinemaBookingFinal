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
            margin-left: 120px; /* Adjust according to sidebar width */
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
.userS{
margin:50 px auto;}
    </style>
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
    <div class="userS">
    <select id="userSelect" style="display:none;">
        <option>Select the Member</option>
        <option>User 1</option>
        <option>User 2</option>
        <option>User 3</option>

    </select>

    </div>

    <div class="container" id="formContainer" style="display: none;">
        <form class="col-lg-8 off offset-lg-1 styles" method="post">
             <div class="form-row required">
                            <div class="form-group required col-md-6">
                                <label class="form-check-label" for="firstName">First name *</label>
                                <input type="text" required class="form-control" id="firstName" name="firstName" placeholder="FirstName">
                            </div>
                            <div class="form-group required col-md-6">
                                <label class="form-check-label" for="lastName">Last name *</label>
                                <input type="text" required class="form-control" id="lastName" name="lastName" placeholder="LastName">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-check-label" for="email">Email *</label>
                            <input type="text" class="form-control" id="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required placeholder="Email">
                        </div>
                        <div class="form-row">
                            <div class="form-group required col-md-6">
                                <label class="form-check-label" for="password">Password *</label>
                                <input type="password" class="form-control" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required placeholder="Password">
                            </div>

                        </div>

            <br />
            <?php
    if(isset($_POST['submit'])) {
        // Database configuration
        $host = "localhost";
        $dbname = "home";
        $username = "root";
        $password = "";

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $firstName = $_POST['firstName'];
                $lastName = $_POST['lastName'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                // Add other form fields as needed

                $userType = 1;

                $sql = "INSERT INTO users (userType, firstName, lastName, email, password)
                VALUES (:userType, :firstName, :lastName, :email, :password)";
        $stmt = $pdo->prepare($sql);

        // Bind parameters
        $params = array(
            ':userType' => 1,
            ':firstName' => $_POST['firstName'],
            ':lastName' => $_POST['lastName'],
            ':email' => $_POST['email'],
            ':password' => $_POST['password']
        );

        // Execute the prepared statement with parameters
        if ($stmt->execute($params)) {
            header("Location: manageusers.php");
            exit;
        } else {
            echo "Error: Unable to add member.";
        }
                } catch(PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
                }
                }
                ?>
            <button type="submit" name="submit" class="btn btn-primary">Add Admin</button>
        </form>
    </div>



</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("addBtn").addEventListener("click", function() {
    document.getElementById("userSelect").style.display = "none";
        document.getElementById("formContainer").style.display = "block";

    });
 document.getElementById("updateBtn").addEventListener("click", function() {

            window.location.href = "update_member.php";
        });

    document.getElementById("deleteBtn").addEventListener("click", function() {
 window.location.href = "delete_member.php";


        // You can customize this part to populate the dropdown with the list of members to be deleted
    });

    document.getElementById("suspendBtn").addEventListener("click", function() {
        window.location.href = "suspend_member.php";


    });
});

</script>
</body>
</html>
