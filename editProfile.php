<?php
// Start the session
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
  // Redirect to login page or handle unauthorized access
  header("Location: login.php");
  exit();
}


// Database connection details
$host = "localhost";
$dbname = "home";
$username = "root";
$password = "";

try {
  // Create a PDO instance
  $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

  // Set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Prepare SQL statement to fetch user data
  $stmt = $conn->prepare("SELECT * FROM users WHERE userID = :user_id");

  // Bind parameters
  $stmt->bindParam(':user_id', $_SESSION['user_id']);

  // Execute the query
  $stmt->execute();

  // Fetch user data
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  // Check if user exists
  if (!$user) {
    // Redirect or handle if user does not exist
    // For example, redirect to a profile creation page
    header("Location: creaAccount.html");
    exit();
  }
  // Fetch user's home address
  $stmt = $conn->prepare("SELECT * FROM home_address WHERE userID = :user_id");
  $stmt->bindParam(':user_id', $_SESSION['user_id']);
  $stmt->execute();
  $address = $stmt->fetch(PDO::FETCH_ASSOC);

  // Fetch user's payment cards
  $stmt = $conn->prepare("SELECT * FROM payment_card WHERE userID = :user_id");
  $stmt->bindParam(':user_id', $_SESSION['user_id']);
  $stmt->execute();
  $payment_cards = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  // Handle database connection error
  echo "Connection failed: " . $e->getMessage();
}



// Close the database connection
$conn = null;

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Profile</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <nav>
    <ul class="nav">
      <li><a href="/Frontend/homepage.php">Home</a></li>
      <li><a href="/Frontend/search.html">Browse Movies</a></li>
      
    </ul>
  </nav>
  
  <form id="creAcc">
    <h1> Edit Profile </h1>

    <label for="firstName"> First Name: </label>
    <input type="text" id="firstName" value="<?php echo htmlspecialchars($user['firstName']); ?>"> <br /> <br />
    <label for="lastName"> Last Name: </label>
    <input type="text" id="lastName" value="<?php echo htmlspecialchars($user['lastName']); ?>"> <br /> <br />
    <label for="email"> Email Address: </label>
    <input type="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" disabled> <br /> <br />
    <label for="optInPromo" style="display: inline-block;">Opt-in for Promotions:</label>
    <input type="checkbox" id="optInPromo" name="optInPromo" <?php echo ($user['optInPromo'] == 1) ? 'checked' : ''; ?> style="display: inline-block; vertical-align: middle;"> <br /><br />

    <input type="checkbox" id="changePwd"> Change Password </label>

    <div id="pwdChanger" style="display: none;">
      <label for="oldPwd"> Old Password: </label>
      <input type="password" id="oldPwd" name="oldPwd1"> <br /> <br />

      <label for="newPwd"> New Password: </label>
      <input type="password" id="newPwd" name="newPwd1"> <br /> <br />

      <input type="checkbox" id="oldPwdView">Show Old Password <br /> <br />
      <input type="checkbox" id="newPwdView">Show New Password <br /> <br />
      <h5>Must contain at least 8 characters</h5>
    </div>
    <br /><br />
    <label for="phone">Phone Number: </label>
    <input type="tel" id="phone" value="<?php echo htmlspecialchars($user['phoneNumber']); ?>" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required><br><br>


    <label class="shipping" for="shipAddress">Address</label>
    <input type="text" id="shipAddress" value="<?php echo isset($address['street']) ? htmlspecialchars($address['street']) : ''; ?>" />

    <label class="shipping" for="shipCountry">Country</label>
    <input type="text" id="shipCountry" value="<?php echo isset($address['country']) ? htmlspecialchars($address['country']) : ''; ?>" />

    <label class="shipping" for="shipZip">Zip Code</label>
    <input type="tel" id="shipZip" value="<?php echo isset($address['zipCode']) ? htmlspecialchars($address['zipCode']) : ''; ?>" />

    <label class="shipping" for="shipCity">City</label>
    <input type="text" id="shipCity" value="<?php echo isset($address['city']) ? htmlspecialchars($address['city']) : ''; ?>" />

    <label class="shipping" for="shipState">State</label>
    <input type="text" id="shipState" value="<?php echo isset($address['state']) ? htmlspecialchars($address['state']) : ''; ?>" />

    <br /> <br /> <br>


    <label>Card 1: </label> <br>

    <ul>
      <li><input type="radio" value="0" name="creDeb1" id="credit1" <?php echo (!empty($payment_cards) && isset($payment_cards[0]['cardType']) && $payment_cards[0]['cardType'] == 0) ? 'checked' : ''; ?>>
        <label for="credit1">Credit</label>
      </li>
      <li><input type="radio" value="1" name="creDeb1" id="debit1" <?php echo (!empty($payment_cards) && isset($payment_cards[0]['cardType']) && $payment_cards[0]['cardType'] == 1) ? 'checked' : ''; ?>>
        <label for="debit1">Debit</label>
      </li>
    </ul>

    <br>
    <?php $encryptedCardNum = base64_decode($payment_cards[0]['cardNumber']);

$encrypt_method = "AES-256-CBC";
$secret_key = 'xxxxxxxxxxxxxxxxxxxxxxxx'; // Same secret key used for encryption
$secret_iv = 'xxxxxxxxxxxxxxxxxxxxxxxxx'; // Same secret IV used for encryption

$key = hash('sha256', $secret_key);    
$iv = substr(hash('sha256', $secret_iv), 0, 16);

$decryptedCardNum = openssl_decrypt($encryptedCardNum, $encrypt_method, $key, 0, $iv);
?>

    <label>Card Number: </label>
    <input type="tel" id="cardNum1" maxlength="19" value="<?php echo (!empty($payment_cards) && isset($decryptedCardNum)) ? $decryptedCardNum : ''; ?>">
   <?php $encryptedExp = base64_decode($payment_cards[0]['expirationDate']);

$encrypt_method = "AES-256-CBC";
$secret_key = 'xxxxxxxxxxxxxxxxxxxxxxxx'; // Same secret key used for encryption
$secret_iv = 'xxxxxxxxxxxxxxxxxxxxxxxxx'; // Same secret IV used for encryption

$key = hash('sha256', $secret_key);    
$iv = substr(hash('sha256', $secret_iv), 0, 16);

$decryptedExp = openssl_decrypt($encryptedExp, $encrypt_method, $key, 0, $iv);
?>
    <label>Expiration Date: </label>
    <input type="tel" value="<?php echo (!empty($payment_cards) && isset($decryptedExp)) ? $decryptedExp : ''; ?>" id="exp1">


    <br> <br>

    <label>Billing Address: </label> <br />

    <label class="billing1" for="billAdd1">Address</label>
    <input type="text" id="billAdd1" value="<?php echo $payment_cards[0]['billingStreet']; ?>">

    <label class="billing1" for="billAddCtry1">Country</label>
    <input type="text" id="billAddCtry1" value="<?php echo $payment_cards[0]['billingCountry']; ?>">

    <label class="billing1" for="billAddZip1">Zipcode</label>
    <input type="tel" id="billAddZip1" value="<?php echo $payment_cards[0]['billingZipCode']; ?>">

    <label class="billing1" for="billAddCity1">City</label>
    <input type="text" id="billAddCity1" value="<?php echo $payment_cards[0]['billingCity']; ?>">

    <label class="billing1" for="billAddState1">State</label>
    <input type="text" id="billAddState1" value="<?php echo $payment_cards[0]['billingState']; ?>">

    <br> <br> <br>


    <label>Card 2: </label> <br>

    <ul>
      <li><input type="radio" value="0" name="creDeb2" id="credit2" <?php echo (!empty($payment_cards) && isset($payment_cards[1]['cardType']) && $payment_cards[1]['cardType'] == 0) ? ' checked' : ''; ?>>
        <label for="credit2">credit</label>
      </li>
      <li><input type="radio" value="1" name="creDeb2" id="debit2" <?php echo (!empty($payment_cards) && isset($payment_cards[1]['cardType']) && $payment_cards[1]['cardType'] == 1) ? ' checked' : ''; ?>>
        <label for="debit2">debit</label>
      </li>
    </ul>

    <br>

    <label>Card Number: </label>
    <input type="tel" id="cardNum2" maxlength="19" value="<?php echo (!empty($payment_cards) && isset($payment_cards[1]['cardNumber'])) ? $payment_cards[1]['cardNumber'] : ''; ?>">

    <label>Expiration Date: </label>
    <input type="tel" value="<?php echo (!empty($payment_cards) && isset($payment_cards[1]['expirationDate'])) ? $payment_cards[1]['expirationDate'] : ''; ?>" id="exp2">

    <br> <br>

    <label>Billing Address: </label> <br />

    <label class="billing2" for="billAdd2">Address</label>
    <input type="text" id="billAdd2" value="<?php echo (!empty($payment_cards) && isset($payment_cards[1]['billingStreet'])) ? $payment_cards[1]['billingStreet'] : ''; ?>">

    <label class="billing2" for="billAddCtry2">Country</label>
    <input type="text" id="billAddCtry2" value="<?php echo (!empty($payment_cards) && isset($payment_cards[1]['billingCountry'])) ? $payment_cards[1]['billingCountry'] : ''; ?>">

    <label class="billing2" for="billAddZip2">Zipcode</label>
    <input type="tel" id="billAddZip2" value="<?php echo (!empty($payment_cards) && isset($payment_cards[1]['billingZipCode'])) ? $payment_cards[1]['billingZipCode'] : ''; ?>">

    <label class="billing2" for="billAddCity2">City</label>
    <input type="text" id="billAddCity2" value="<?php echo (!empty($payment_cards) && isset($payment_cards[1]['billingCity'])) ? $payment_cards[1]['billingCity'] : ''; ?>">

    <label class="billing2" for="billAddState2">State</label>
    <input type="text" id="billAddState2" value="<?php echo (!empty($payment_cards) && isset($payment_cards[1]['billingState'])) ? $payment_cards[1]['billingState'] : ''; ?>">

    <br> <br> <br>


    <label>Card 3: </label> <br>

    <ul>
      <li><input type="radio" value="0" name="creDeb3" id="credit3" <?php echo (!empty($payment_cards) && isset($payment_cards[2]['cardType']) && $payment_cards[2]['cardType'] == 0) ? ' checked' : ''; ?>>
        <label for="credit3">credit</label>
      </li>
      <li><input type="radio" value="1" name="creDeb3" id="debit3" <?php echo (!empty($payment_cards) && isset($payment_cards[2]['cardType']) && $payment_cards[2]['cardType'] == 1) ? ' checked' : ''; ?>>
        <label for="debit3">debit</label>
      </li>
    </ul>

    <br>

    <label>Card Number: </label>
    <input type="tel" id="cardNum3" maxlength="19" value="<?php echo (!empty($payment_cards) && isset($payment_cards[2]['cardNumber'])) ? $payment_cards[2]['cardNumber'] : ''; ?>" placeholder="1234 5678 9123 4567">

    <label>Expiration Date: </label>
    <input type="tel" value="<?php echo (!empty($payment_cards) && isset($payment_cards[2]['expirationDate'])) ? $payment_cards[2]['expirationDate'] : ''; ?>" placeholder="MM/YY" id="exp3">

    <br> <br>

    <label>Billing Address: </label> <br />

    <label class="billing3" for="billAdd3">Address</label>
    <input type="text" id="billAdd3" value="<?php echo (!empty($payment_cards) && isset($payment_cards[2]['billingStreet'])) ? $payment_cards[2]['billingStreet'] : ''; ?>" placeholder="1111 nightsky lane">

    <label class="billing3" for="billAddCtry3">Country</label>
    <input type="text" id="billAddCtry3" value="<?php echo (!empty($payment_cards) && isset($payment_cards[2]['billingCountry'])) ? $payment_cards[2]['billingCountry'] : ''; ?>" placeholder="United States">

    <label class="billing3" for="billAddZip3">Zipcode</label>
    <input type="tel" id="billAddZip3" value="<?php echo (!empty($payment_cards) && isset($payment_cards[2]['billingZipCode'])) ? $payment_cards[2]['billingZipCode'] : ''; ?>" placeholder="30060">

    <label class="billing3" for="billAddCity3">City</label>
    <input type="text" id="billAddCity3" value="<?php echo (!empty($payment_cards) && isset($payment_cards[2]['billingCity'])) ? $payment_cards[2]['billingCity'] : ''; ?>" placeholder="Orlando">

    <label class="billing3" for="billAddState3">State</label>
    <input type="text" id="billAddState3" value="<?php echo (!empty($payment_cards) && isset($payment_cards[2]['billingState'])) ? $payment_cards[2]['billingState'] : ''; ?>" placeholder="Florida">

    <br> <br> <br>


  </form>



  <input type="button" id="submit" value="Confirm Changes">


  <div>
    <br> <br>
  </div>

  <script src="editProfile.js"></script>
  <script>
    document.getElementById('changePwd').addEventListener('change', function() {
      var pwdChanger = document.getElementById('pwdChanger');
      pwdChanger.style.display = this.checked ? 'block' : 'none';
    });
  </script>
</body>

</html>