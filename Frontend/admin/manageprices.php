<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <title>Manage Prices</title>
    <style>
        body {
            background-size: cover;
            background-attachment: fixed;
            animation: animateBackground 20s linear infinite;
            color: white;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
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
            padding-top: 8px; /* Reduce top padding on hover */
            padding-bottom: 8px; /* Reduce bottom padding on hover */
            background-color: #555;
        }

        .sidebar .active {
            background-color: #555;
        }

        .sidebar .nav-item {
            margin-bottom: 10px;
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

        .nav-item {
            margin-left: 25px;
        }

        .navbar-nav.ml-auto {
            position: absolute;
            bottom: 0;
        }

        .container {
            margin-left: 250px;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: green;
            margin-bottom: 25px;
        }

        select, input[type="text"], input[type="number"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            color: #000; /* Change field value color here */
        }

        .formLabel {
            color: red;
        }

        .btn-container {
            text-align: center;
        }

        .btn {
            margin: 10px;
        }

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
            <a class="nav-link" href="./manageusers.php">Manage Users</a>
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
<div class="container">
    <div class="bottom-content">
        <h1>Modify Prices</h1>
        <form class="movieForm" method="post">
            <div class="container my-container">
                <table>
                    <?php
                    // Database connection
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "home";

                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Check if the form is submitted
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        // Retrieve form data
                        $childPrice = $_POST['childPrice'];
                        $adultPrice = $_POST['adultPrice'];
                        $seniorPrice = $_POST['seniorPrice'];
                        $salesTax = $_POST['salesTax'];
                        $bookingFee = $_POST['bookingFee'];

                        // Update prices in the database
                        $sql = "UPDATE prices SET childPrice='$childPrice', adultPrice='$adultPrice', seniorPrice='$seniorPrice', salesTax='$salesTax', bookingFee='$bookingFee' WHERE id=1";

                        if ($conn->query($sql) === TRUE) {
                            echo "Prices updated successfully";
                        } else {
                            echo "Error updating prices: " . $conn->error;
                        }
                    }

                    // Fetch prices from the database
                    $sql = "SELECT * FROM prices";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while ($row = $result->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td><label class="formLabel" for="childPrice">Enter ticket price for Child:</label></td>';
                            echo '<td><input type="text" required id="childPrice" placeholder="Price in $" name="childPrice" value="' . $row["childPrice"] . '"></td>';
                            echo '</tr>';
                            echo '<tr>';
                            echo '<td><label class="formLabel" for="adultPrice">Enter ticket price for Adult:</label></td>';
                            echo '<td><input type="text" required id="adultPrice" placeholder="Price in $" name="adultPrice" value="' . $row["adultPrice"] . '"></td>';
                            echo '</tr>';
                            echo '<tr>';
                            echo '<td><label class="formLabel" for="seniorPrice">Enter ticket price for Senior:</label></td>';
                            echo '<td><input type="text" required id="seniorPrice" placeholder="Price in $" name="seniorPrice" value="' . $row["seniorPrice"] . '"></td>';
                            echo '</tr>';
                            echo '<tr>';
                            echo '<td><label class="formLabel" for="salesTax">Enter Sales Tax:</label></td>';
                            echo '<td><input type="text" required id="salesTax" placeholder="Price in $" name="salesTax" value="' . $row["salesTax"] . '"></td>';
                            echo '</tr>';
                            echo '<tr>';
                            echo '<td><label class="formLabel" for="bookingFee">Additional online booking fees:</label></td>';
                            echo '<td><input type="number" required id="bookingFee" placeholder="$" name="bookingFee" value="' . $row["bookingFee"] . '"></td>';
                            echo '</tr>';
                        }
                    } else {
                        echo "0 results";
                    }
                    $conn->close();
                    ?>
                </table>
            </div>
            <div class="btn-container">
                <input type="submit" class="btn btn-success" value="Save">
                <input type="button" class="btn btn-danger" value="Cancel">
            </div>
        </form>
    </div>
</div>
</body>
</html>
