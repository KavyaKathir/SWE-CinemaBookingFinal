<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <title>Manage Movies</title>
    <style>
        /* Custom styling */
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
        }

        .btn-manage-movies {
            background-color: #007bff !important; /* Blue color */
            color: #fff;
        }
        .btn-schedule-movies {
            background-color: #ff7f00 !important; /* Orange color */
            color: #fff;
        }
        .btn-manage-movies:focus,
        .btn-manage-movies:hover {
            background-color:red !important; /* Blue color */
            color: #fff;
        }
        .btn-schedule-movies:focus,
        .btn-schedule-movies:hover {
            background-color: green !important; /* Orange color */
            color: #fff;
        }
        .btn-secondary,
        .btn-secondary :focus
        {
            background-color: brown ;
        }
        /* Additional styles */
        .container {
            margin-top: 70px; /* Adjust according to your navigation bar height */

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
    <div class="container">
        <div id="scheduleMoviesSection" >
            <div class="bottom-content">

                <input type="button" class="btn btn-secondary" value="Add Schedule" onclick="manageShowtimes('add')">
                <input type="button" class="btn btn-secondary" value="Edit Schedule" onclick="manageShowtimes('edit')">
                <input type="button" class="btn btn-secondary" value="Delete Schedule" onclick="manageShowtimes('delete')">
                <br><br>

                <div id="addScheduleForm">
                    <h4>Add Schedule</h4>
                    <select id="schedulemovieDropdown" name="schedulemovieDropdown">
                        <option>Select the Movie</option>
                        <!-- Options for movies will be dynamically populated here -->
                        <?php
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

                        // Query to retrieve movie titles from the database
                        $query = "SELECT title FROM movies";
                        $result = mysqli_query($conn, $query);

                        if (!$result) {
                            die("Query failed: " . mysqli_error($conn));
                        }

                        // Loop through the results and populate the dropdown options
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<option>' . $row['title'] . '</option>';
                        }

                        // Close connection
                        $conn->close();
                        ?>
                    </select>

                    <br/><br>
                    <form id="addScheduleForm" class="movieForm" method="post">
                        <table>
                        <tr>
                        <input type="hidden" id="movieTitle" name="movieTitle" value="">
                        </tr>
                            <tr>
                                <td><label class="formLabel" for="date">Show Date:</label></td>
                                <td><input type="date" id="date" placeholder="Enter Show Date" name="date" value=""></td>
                            </tr>
                            <tr>
                                <td><label class="formLabel" for="time">Show Time:</label></td>
                                <td>
                                    <select required id="time" name="time">
                                        <option value="12">11:00</option>
                                        <option value="21">19:00</option>
                                    </select>
                                </td>
                            </tr>
                            <!-- For add schedule, additional fields for showroom will be shown -->
                            <tr>
                                <td><label class="formLabel">Showroom</label></td>
                                <td><input type="text" id="showroom" name="showroom" placeholder="1"></td>
                            </tr>
                        </table>
                        <div class="container my-container btn">
                            <input type="submit" class="btn btn-success" value="Submit">
                            <input type="button" class="btn btn-danger" value="Cancel">
                        </div>
                    
                    </form>
                    <script>
                                            // Function to update the hidden input field with the selected movie title
                                            document.getElementById('schedulemovieDropdown').addEventListener('change', function() {
                                                var selectedMovie = this.value;
                                                document.getElementById('movieTitle').value = selectedMovie;
                                            });
                                        </script>
                    <?php
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

                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $movieTitle = $_POST['movieTitle']; // Assuming you have a name attribute in your movie dropdown
                            $date = $_POST['date'];
                            $time = $_POST['time'];
                            $showroom = $_POST['showroom'];
if ($time == "12") {
        $selectedTime = "11:00";
    } elseif ($time == "21") {
        $selectedTime = "19:00";
    }
                            // Retrieve movie ID based on movie title
                            $movieQuery = "SELECT id FROM movies WHERE title = '$movieTitle'";
                            $movieResult = mysqli_query($conn, $movieQuery);
                            if ($movieResult) {
                                $movieRow = mysqli_fetch_assoc($movieResult);
                                $movieID = $movieRow['id'];

                                // Insert values into the show table
                                $insertQuery = "INSERT INTO `show` (`date`, `time`, `movieID`, `showroomID`) VALUES ('$date', '$selectedTime', '$movieID', '$showroom')";
                                if ($conn->query($insertQuery) === TRUE) {
                                    echo "success";
                                } else {
                                    echo "Error: " . $insertQuery . "<br>" . $conn->error;
                                }
                            } else {
                                echo "Error retrieving movie ID: " . mysqli_error($conn);
                            }
                        }

                        // Close connection
                        $conn->close();
                    ?>

                </div>

                <div id="editScheduleForm" class="hidden">
                    <h4>Edit Schedule</h4>
                    <!-- Form for editing schedule -->
                    <select id="editschedulemovieDropdown" name="editschedulemovieDropdown">
                                            <option>Select the Movie</option>
                                            <!-- Options for movies will be dynamically populated here -->
                                            <?php
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

                                                // Query to retrieve movie titles from the database
                                                $query = "SELECT title FROM movies";
                                                $result = mysqli_query($conn, $query);

                                                if (!$result) {
                                                    die("Query failed: " . mysqli_error($conn));
                                                }

                                                // Loop through the results and populate the dropdown options
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    echo '<option>' . $row['title'] . '</option>';
                                                }

                                                // Close connection
                                                $conn->close();
                                            ?>
                                        </select>

                    <br/><br>
                    <form id="editScheduleForm" class="movieForm" method="post" action="./editschedule.php">
                        <table>
                        <tr>
                                                <input type="hidden" id="movieTitles" name="movieTitles" value="">
                                                </tr>
                            <tr>
                                <td><label class="formLabel" for="editDate">Show Date:</label></td>
                                <td><input type="date" id="editDate"  name="editDate" value=""></td>
                            </tr>
                            <tr>
                                <td><label class="formLabel" for="editTime">Show Time:</label></td>
                                <td>
                                    <select required id="editTime" name="editTime">
                                        <option >11:00</option>
                                        <option >19:00</option>
                                    </select>
                                </td>
                            </tr>
                            <!-- For edit schedule, additional fields for showroom will be shown -->
                            <tr>
                                <td><label class="formLabel">Showroom</label></td>
                                <td><input type="text" id="editShowroom" name="editShowroom"></td>
                            </tr>
                        </table>
                        <div class="container my-container btn">
                            <input type="submit" class="btn btn-success" value="Submit">
                            <input type="button" class="btn btn-danger" value="Cancel">
                        </div>
                   
                    </form>
                    <script>
                                                               // Function to update the hidden input field with the selected movie title
                                                               document.getElementById('editschedulemovieDropdown').addEventListener('change', function() {
                                                                   var selectedMovie = this.value;
                                                                   document.getElementById('movieTitles').value = selectedMovie;
                                                               });
                                                           </script>

                </div>

                <div id="deleteScheduleForm" class="hidden">
                    <h4>Delete Schedule</h4>
                    <!-- Form for deleting schedule -->
                    <select id="deleteschedulemovieDropdown" name="deleteschedulemovieDropdown">
                                            <option>Select the Movie</option>
                                            <!-- Options for movies will be dynamically populated here -->
                                            <?php
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

                                                // Query to retrieve movie titles from the database
                                                $query = "SELECT title FROM movies";
                                                $result = mysqli_query($conn, $query);

                                                if (!$result) {
                                                    die("Query failed: " . mysqli_error($conn));
                                                }

                                                // Loop through the results and populate the dropdown options
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    echo '<option>' . $row['title'] . '</option>';
                                                }

                                                // Close connection
                                                $conn->close();
                                            ?>
                                        </select>

                    <br/><br>
                    <form id="deleteScheduleForm" class="movieForm" method="post" action="./deleteschedule.php">
                       <table>
                         <tr>
                                      <input type="hidden" id="movieTitleu" name="movieTitleu" value="">
                                               </tr>
                                                   <tr>
                                <td><label class="formLabel" for="deleteDate">Show Date:</label></td>
                                <td><input type="date" id="deleteDate" placeholder="Enter Show Date" name="deleteDate" value=""></td>
                            </tr>
                            <tr>
                                <td><label class="formLabel" for="deleteTime">Show Time:</label></td>
                                <td>
                                    <select required id="deleteTime" name="deleteTime">
                                        <option >11:00</option>
                                        <option >19:00</option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                        <div class="container my-container btn">
                            <input type="submit" class="btn btn-success" value="Submit">
                            <input type="button" class="btn btn-danger" value="Cancel">
                        </div>
                    </form>
                     <script>
                                                                                   // Function to update the hidden input field with the selected movie title
                                                                                   document.getElementById('deleteschedulemovieDropdown').addEventListener('change', function() {
                                                                                       var selectedMovie = this.value;
                                                                                       document.getElementById('movieTitleu').value = selectedMovie;
                                                                                   });
                                                                               </script>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function manageShowtimes(action) {
        var addScheduleForm = document.getElementById('addScheduleForm');
        var editScheduleForm = document.getElementById('editScheduleForm');
        var deleteScheduleForm = document.getElementById('deleteScheduleForm');

        if (action === 'add') {
            addScheduleForm.classList.remove('hidden');
            editScheduleForm.classList.add('hidden');
            deleteScheduleForm.classList.add('hidden');
        } else if (action === 'edit') {
            addScheduleForm.classList.add('hidden');
            editScheduleForm.classList.remove('hidden');
            deleteScheduleForm.classList.add('hidden');
        } else if (action === 'delete') {
            addScheduleForm.classList.add('hidden');
            editScheduleForm.classList.add('hidden');
            deleteScheduleForm.classList.remove('hidden');
        }
    }

</script>

</body>
</html>
