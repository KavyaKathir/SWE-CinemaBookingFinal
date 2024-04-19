

User
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <title>Manage Promotions</title>
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
            padding: 10px 20px 10px 30px; /* Adjusted padding here */
            text-decoration: none;
            font-size: 18px;
            color: white;
            display: block;
            transition: background-color 0.3s;
        }

        .sidebar a:hover {
            padding-top: 20px;
            padding-bottom: 8px;
            background-color: #555;
        }

        .sidebar .active {
            background-color: #555;
        }

        .sidebar .nav-item {
            margin-bottom: 10px;
            margin-left: 25px;
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
            margin-left: 250px;
            padding: 20px;
        }


        h1 {
            text-align: center;
            color: green;
            margin-bottom:25px;
        }


        h2 {
            text-align: center;
            color: white;
            margin-bottom:25px;
            font-size: 39;
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

        /* Hide sections initially */
        .hide {
            display: none;
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
            background-color: #007bff;
        }
        .btn-manage-movies:hover, .btn-schedule-movies:hover {
            background-color: #3f3f3f;
        }

        .btn-secondary {
            color: #fff;
        }
        .btn-secondary {
            background-color: #8d0a0a;
        }

    </style>
</head>
<body>

<nav class="sidebar">
    <a class="navbar-brand" href="/Frontend/homepage.php">
        <img src="/Frontend/img/lo.png" style="width:150px; height:50px;">
        <h2 class="logo">MOVIELANE</h1>
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


<div class="container text-center"> <!-- Added class "text-center" for center alignment -->
    <div class="bottom-content">
        <h1>Manage Promotions</h1>

        <!-- Add Promotion Button -->
        <button class="btn btn-primary add-promotion-btn">Add Promotion</button>

        <!-- Edit Promotion Button -->
        <button class="btn btn-secondary edit-promotion-btn">Edit Promotion</button>

        <!-- Delete Promotion Button -->
        <button class="btn btn-danger delete-promotion-btn">Delete Promotion</button>

        <!-- Send Promo Email Button -->
        <button class="btn btn-success send-promo-email-btn">Send Promotion Email</button>

        <!-- Add Promotion Form -->
        <!-- Add Promotion Form -->
        <section class="add-promotion-form hide">
            <form class="addmovieForm" method="post">
                <table>
                    <tr>
                        <td><label class="formLabel" for="code">Promotion Name</label></td>
                        <td><input type="text" id="code" placeholder="Enter Promo Name" name="add_code"></td>
                    </tr>
                    <tr>
                        <td><label class="formLabel" for="add_discount">Discount:</label></td>
                        <td><input type="number" id="add_discount" placeholder="Enter Discount(%)" name="add_discount"></td>
                    </tr>
                    <tr>
                        <td><label class="formLabel" for="add_start">Start date</label></td>
                        <td><input type="text" id="add_start" placeholder="yyyy/mm/dd" name="add_start" ></td>
                    </tr>
                    <tr>
                        <td><label class="formLabel" for="add_end">End date</label></td>
                        <td><input type="text" id="add_end" name="add_end" placeholder="yyyy/mm/dd" ></td>
                    </tr>
                </table>
                <div class="btn-container">
                    <input type="submit" class="btn btn-success"  value="Save">
                    <input type="button" class="btn btn-danger cancel-btn" value="Cancel">
                </div>
            </form>

            <script>
    document.querySelector('.addmovieForm').addEventListener('submit', function(event) {
        // Prevent default form submission
        event.preventDefault();

        // Fetch form data
        const formData = new FormData(this);

        // Send form data to the server using fetch API
        fetch('add_promotion.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (response.ok) {
                // If the response is successful, display a success message
                alert('Promotion added successfully.');
            } else {
                // If there's an error, display the error message
                throw new Error('Failed to add promotion.');
            }
        })
        .catch(error => {
            // Display error message
            alert(error.message);
        });
    });
</script>
        </section>
     

<!-- Edit Promotion Form -->
<section class="edit-promotion-form">
    <?php
    // Assuming you have already established a database connection
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "home";

    // Create connection
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Function to fetch promotion names from the database
    function fetchPromotionNames($pdo)
    {
        $stmt = $pdo->prepare("SELECT promotionCode FROM promotion");
        $stmt->execute();
        $promotionNames = $stmt->fetchAll(PDO::FETCH_COLUMN);
        return $promotionNames;
    }

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form submission
    $promotionName = $_POST['promotion_name'];
    $startDate = $_POST['edit_start'];
    $endDate = $_POST['edit_end'];
    $discount = $_POST['edit_discount'];

    // Update promotion details in the database
    $stmt = $pdo->prepare("UPDATE promotion SET startDate = :startDate, expirationDate = :endDate, discount = :discount WHERE promotionCode = :promotionName");
    $stmt->bindParam(':startDate', $startDate);
    $stmt->bindParam(':endDate', $endDate);
    $stmt->bindParam(':discount', $discount);
    $stmt->bindParam(':promotionName', $promotionName);
    $stmt->execute();


}

    // Fetch promotion names from the database
    $promotionNames = fetchPromotionNames($pdo);
    ?>
    <form class="editmovieForm" id="promotionForm" method="post">
        <select name="promotion_name" id="promotion_name">
            <option>Select Promotion</option>
            <?php foreach ($promotionNames as $promotion): ?>
                <option value="<?php echo $promotion; ?>"><?php echo $promotion; ?></option>
            <?php endforeach; ?>
        </select>
        <table>
            <tr>
                <td><label class="formLabel" for="discount">Discount:</label></td>
                <td><input type="number" id="edit_discount" placeholder="Enter Discount(%)" name="edit_discount"></td>
            </tr>
            <tr>
                <td><label class="formLabel" for="start">Start date</label></td>
                <td><input type="text" id="edit_start" placeholder="mm/dd/yyyy" name="edit_start"></td>
            </tr>
            <tr>
                <td><label class="formLabel" for="end">End date</label></td>
                <td><input type="text" id="edit_end" placeholder="mm/dd/yyyy" name="edit_end"></td>
            </tr>
        </table>
        <div class="btn-container">
            <input type="submit" class="btn btn-success" value="Save">
            <input type="button" class="btn btn-danger cancel-btn" value="Cancel">
        </div>
    </form>

    <script>
document.getElementById('promotion_name').addEventListener('change', function() {
    var promotionName = this.value;

    // Make an AJAX request to fetch promotion details
    fetch('fetch_promotion_details.php?promotion_name=' + promotionName)
        .then(response => response.json())
        .then(data => {
            // Update form fields with fetched promotion details
            document.getElementById('edit_discount').value = data.discount;
            document.getElementById('edit_start').value = data.startDate;
            document.getElementById('edit_end').value = data.expirationDate;
        })
        .catch(error => console.error('Error fetching promotion details:', error));
});

</script>

</section>






      <!-- Delete Promotion Form -->
      <section class="delete-promotion-form hide">
          <form class="deletemovieForm" method="post">
              <select name="promotion_to_delete">
                  <option>Select Promotion</option>
                  <?php
                  // Fetch promotions from the database and populate dropdown
                  $stmt = $pdo->query("SELECT promotionCode FROM promotion");
                  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                      echo "<option>{$row['promotionCode']}</option>";
                  }
                  ?>
              </select>
              <div class="btn-container">
                  <input type="submit" class="btn btn-danger" value="Delete" name="delete_promotion">
                  <input type="button" class="btn btn-secondary cancel-btn" value="Cancel">
              </div>
          </form>
      <?php
      // Handle form submission
      if(isset($_POST['delete_promotion'])) {
          // Get selected promotion code
          $promotionCode = $_POST['promotion_to_delete'];

          // Delete promotion from the database
          $stmt = $pdo->prepare("DELETE FROM promotion WHERE promotionCode = :promotionCode");
          $stmt->bindParam(':promotionCode', $promotionCode);
          $stmt->execute();
echo "promotion deleted successfully";

      }
      ?>

      </section>


        <!-- Send Promo Email Form -->
        <section class="send-promo-email-form hide">
            <select id="promoUserDropdown" name="promoUserDropdown">
                <option>Select User</option>
                <?php
                // Connect to the database
                $servername = "localhost"; // Change this to your server name if it's different
                $username = "root";
                $password = "";
                $database = "home";

                try {
                    $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // Fetch users with userType = 2 from the database
                    $stmtx = $pdo->prepare("SELECT userID, firstName, lastName FROM users WHERE userType = 2 and optInPromo=1");
                    $stmtx->execute();

                    // Populate the dropdown with user options
                    while ($row = $stmtx->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . $row['userID'] . "'>" . $row['firstName'] . " " . $row['lastName'] . "</option>";
                    }
                } catch (PDOException $e) {
                    echo "Connection failed: " . $e->getMessage();
                }

                ?>
            </select>
            <select id="promoDropdown" name="promoDropdown">
                <option>Select Promotion</option>
                <?php
                // Fetch promotions from the database and populate dropdown
                $stmt = $pdo->query("SELECT promotionCode FROM promotion");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option>{$row['promotionCode']}</option>";
                }
                ?>
            </select>
            <form class="sendpromomovieForm" method="post" action="./sendpromo.php">

                                                  <input type="hidden" id="promoName" name="promoName" value="">
                                                  <input type="hidden" id="promoUser" name="promoUser" value="">

                <!-- Additional fields for sending promo email -->
                <div class="btn-container">
                    <input type="submit" class="btn btn-success" value="Send">
                    <input type="button" class="btn btn-danger cancel-btn" value="Cancel">
                </div>
             <script>
                                                                                                           // Function to update the hidden input field with the selected movie title
                  document.getElementById('promoDropdown').addEventListener('change', function() {
                 var selectedPromo = this.value;
                  document.getElementById('promoName').value = selectedPromo;
                 });
                    document.getElementById('promoUserDropdown').addEventListener('change', function() {
                    var selectedPromoUser = this.value;
                    document.getElementById('promoUser').value = selectedPromoUser;
                                                                                                   });
                                                                                                   document.querySelector('.sendpromomovieForm').addEventListener('submit', function(event) {
    // Prevent default form submission
    event.preventDefault();

    // Log to check if the event listener is being triggered
    console.log('Form submitted');

    // Fetch form data
    const formData = new FormData(this);
    console.log('Form data:', formData);

    // Send form data to the server using fetch API
    fetch('./sendpromo.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (response.ok) {
            // If the response is successful, display a success message
            alert('Promotion email sent successfully.');
        } else {
            // If there's an error, display the error message
            throw new Error('Failed to send promotion email.');
        }
    })
    .catch(error => {
        // Display error message
        alert(error.message);
    });
});


                                                                                                       </script>
            </form>

               </section>

    </div>
</div>

<script>
    // Functionality to show respective sections on button clicks
    document.addEventListener('DOMContentLoaded', function() {
        const addPromotionBtn = document.querySelector('.add-promotion-btn');
        const editPromotionBtn = document.querySelector('.edit-promotion-btn');
        const deletePromotionBtn = document.querySelector('.delete-promotion-btn');
        const sendPromoEmailBtn = document.querySelector('.send-promo-email-btn');

        const addPromotionForm = document.querySelector('.add-promotion-form');
        const editPromotionForm = document.querySelector('.edit-promotion-form');
        const deletePromotionForm = document.querySelector('.delete-promotion-form');
        const sendPromoEmailForm = document.querySelector('.send-promo-email-form');

        addPromotionBtn.addEventListener('click', function() {
            showSection(addPromotionForm);
        });

        editPromotionBtn.addEventListener('click', function() {
            showSection(editPromotionForm);
        });

        deletePromotionBtn.addEventListener('click', function() {
            showSection(deletePromotionForm);
        });

        sendPromoEmailBtn.addEventListener('click', function() {
            showSection(sendPromoEmailForm);
        });

        // Function to hide all sections
        function hideAllSections() {
            addPromotionForm.classList.add('hide');
            editPromotionForm.classList.add('hide');
            deletePromotionForm.classList.add('hide');
            sendPromoEmailForm.classList.add('hide');
        }

        // Function to show a specific section
        function showSection(section) {
            hideAllSections();
            section.classList.remove('hide');
        }
    });
</script>

</body>
</html>
