 <?php
                                        // Check if form is submitted
                                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                            // Check if all required fields are present
                                            if (isset($_POST['editDate']) && isset($_POST['editTime']) && isset($_POST['editShowroom']) && isset($_POST['movieTitles'])) {
                                                $editDate = $_POST['editDate'];
                                                $editTime = $_POST['editTime'];
                                                $editShowroom = $_POST['editShowroom'];
                                                $movieTitle = $_POST['movieTitles'];

                                                // Database connection parameters
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

                                                // Retrieve movie ID based on movie title
                                                $movieQuery = "SELECT id FROM movies WHERE title = '$movieTitle'";
                                                $movieResult = mysqli_query($conn, $movieQuery);

                                                if ($movieResult) {
                                                    $movieRow = mysqli_fetch_assoc($movieResult);
                                                    $movieID = $movieRow['id'];

                                                    // Update the show table
                                                    $updateQuery = "UPDATE `show` SET `date` = '$editDate', `time` = '$editTime', `showroomID` = '$editShowroom' WHERE `movieID` = '$movieID'";
                                                    if ($conn->query($updateQuery) === TRUE) {
header("Location: manageschedules.php");
exit;
                                                    } else {
                                                        echo "Error updating schedule: " . $conn->error;
                                                    }
                                                } else {
                                                    echo "Error retrieving movie ID: " . mysqli_error($conn);
                                                }

                                                // Close connection
                                                $conn->close();
                                            } else {
                                                echo "All fields are required";
                                            }
                                        }
                                        ?>
