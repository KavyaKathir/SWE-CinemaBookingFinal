<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header('Location: login.php');
    exit();
}

// Define database connection details
$host = "localhost";
$dbname = "home";
$username = "root";
$password = "";

// Create a PDO database connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Handle database connection error
    echo "Connection failed: " . $e->getMessage();
    exit();
}

// Check if form data is received via AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data from AJAX request
    $user_id = $_SESSION['user_id'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];

    $optInPromo = $_POST['optInPromo'];
    $phone = $_POST['phone'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $zipCode = $_POST['zipCode'];


    // Retrieve card1 data from AJAX request
    $cardType1 = $_POST['cardType1'];
    $cardNumber1 = $_POST['cardNumber1'];
    $expirationDate1 = $_POST['expirationDate1'];
    $billingStreet1 = $_POST['billingStreet1'];
    $billingCity1 = $_POST['billingCity1'];
    $billingState1 = $_POST['billingState1'];
    $billingCountry1 = $_POST['billingCountry1'];
    $billingZipCode1 = $_POST['billingZipCode1'];

    // Retrieve card2 data from AJAX request
    $cardType2 = $_POST['cardType2'];
    $cardNumber2 = $_POST['cardNumber2'];
    $expirationDate2 = $_POST['expirationDate2'];
    $billingStreet2 = $_POST['billingStreet2'];
    $billingCity2 = $_POST['billingCity2'];
    $billingState2 = $_POST['billingState2'];
    $billingCountry2 = $_POST['billingCountry2'];
    $billingZipCode2 = $_POST['billingZipCode2'];

    // Retrieve card3 data from AJAX request
    $cardType3 = $_POST['cardType3'];
    $cardNumber3 = $_POST['cardNumber3'];
    $expirationDate3 = $_POST['expirationDate3'];
    $billingStreet3 = $_POST['billingStreet3'];
    $billingCity3 = $_POST['billingCity3'];
    $billingState3 = $_POST['billingState3'];
    $billingCountry3 = $_POST['billingCountry3'];
    $billingZipCode3 = $_POST['billingZipCode3'];

    

$encrypt_method = "AES-256-CBC";
$secret_key = 'xxxxxxxxxxxxxxxxxxxxxxxx'; // Same secret key used for encryption
$secret_iv = 'xxxxxxxxxxxxxxxxxxxxxxxxx'; // Same secret IV used for encryption

$key = hash('sha256', $secret_key);    
$iv = substr(hash('sha256', $secret_iv), 0, 16);
$updatedEncryptedCardNum=null;
// Encrypt the updated expiration date
$updatedEncryptedCardNum = openssl_encrypt($cardNumber1, $encrypt_method, $key, 0, $iv);
$updatedEncryptedCardNum = base64_encode($updatedEncryptedCardNum);
$updatedEncryptedExp=null;
// Encrypt the updated expiration date
$updatedEncryptedExp = openssl_encrypt($expirationDate1, $encrypt_method, $key, 0, $iv);
$updatedEncryptedExp = base64_encode($updatedEncryptedExp);

    // Prepare and execute SQL statement to update user profile
    $stmt = $pdo->prepare("UPDATE users SET firstName = :firstName, lastName = :lastName, email = :email,  phoneNumber = :phone, optInPromo = :optInPromo WHERE userID = :user_id");
    $stmt->execute(['firstName' => $firstName, 'lastName' => $lastName, 'email' => $email, 'phone' => $phone, 'optInPromo' => $optInPromo, 'user_id' => $user_id]);

    // Prepare and execute SQL statement to update home address
    $stmt_address = $pdo->prepare("UPDATE home_address SET street = :street, city = :city, state = :state, country = :country, zipCode = :zipCode WHERE userID = :userID");
    $stmt_address->execute(['street' => $street, 'city' => $city, 'state' => $state, 'country' => $country, 'zipCode' => $zipCode, 'userID' => $user_id]);

    // Prepare and execute SQL statement to update payment card for card 1
    $stmt_card1 = $pdo->prepare("UPDATE payment_card SET cardType = :cardType, cardNumber = :cardNumber, expirationDate = :expirationDate, billingStreet = :billingStreet, billingCity = :billingCity, billingState = :billingState, billingCountry = :billingCountry, billingZipCode = :billingZipCode WHERE userID = :userID AND paymentCardID = :paymentCardID");
    $stmt_card1->execute(['cardType' => $cardType1, 'cardNumber' => $updatedEncryptedCardNum, 'expirationDate' => $updatedEncryptedExp, 'billingStreet' => $billingStreet1, 'billingCity' => $billingCity1, 'billingState' => $billingState1, 'billingCountry' => $billingCountry1, 'billingZipCode' => $billingZipCode1, 'userID' =>$user_id, 'paymentCardID' => 1]); // Use the appropriate paymentCardID for card 1]);

    // Prepare and execute SQL statement to update payment card for card 2
    $stmt_card2 = $pdo->prepare("UPDATE payment_card SET cardType = :cardType, cardNumber = :cardNumber, expirationDate = :expirationDate, billingStreet = :billingStreet, billingCity = :billingCity, billingState = :billingState, billingCountry = :billingCountry, billingZipCode = :billingZipCode WHERE userID = :userID AND paymentCardID = :paymentCardID");
    $stmt_card2->execute(['cardType' => $cardType2, 'cardNumber' => $cardNumber2, 'expirationDate' => $expirationDate2, 'billingStreet' => $billingStreet2, 'billingCity' => $billingCity2, 'billingState' => $billingState2, 'billingCountry' => $billingCountry2, 'billingZipCode' => $billingZipCode2, 'userID' => $user_id, 'paymentCardID' => 2]); // Use the appropriate paymentCardID for card 2]);

    // Prepare and execute SQL statement to update payment card for card 3
    $stmt_card3 = $pdo->prepare("UPDATE payment_card SET cardType = :cardType, cardNumber = :cardNumber, expirationDate = :expirationDate, billingStreet = :billingStreet, billingCity = :billingCity, billingState = :billingState, billingCountry = :billingCountry, billingZipCode = :billingZipCode WHERE userID = :userID AND paymentCardID = :paymentCardID");
    $stmt_card3->execute(['cardType' => $cardType3, 'cardNumber' => $cardNumber3, 'expirationDate' => $expirationDate3, 'billingStreet' => $billingStreet3, 'billingCity' => $billingCity3, 'billingState' => $billingState3, 'billingCountry' => $billingCountry3, 'billingZipCode' => $billingZipCode3, 'userID' => $user_id, 'paymentCardID' => 3]); // Use the appropriate paymentCardID for card 3

    // Check if update was successful
    if ($stmt->rowCount() > 0 || $stmt_address->rowCount() > 0 || $stmt_card1->rowCount() > 0 || $stmt_card2->rowCount() > 0 || $stmt_card3->rowCount() > 0) { // Check user profile, address, and card updates
        // Profile updated successfully
       
    $stmt = $pdo->query("SELECT accountID FROM users ORDER BY userID DESC LIMIT 1");
    $account_id = $stmt->fetchColumn();
    $stmt1 = $pdo->query("SELECT email FROM users ORDER BY userID DESC LIMIT 1");
    $email = $stmt1->fetchColumn();
    $stmt2 = $pdo->query("SELECT firstname FROM users ORDER BY userID DESC LIMIT 1");
    $firstname = $stmt2->fetchColumn();
    $subject = "Your MOVIELANE account has been updated";
$message = "Hi $firstname,

YOUR PROFILE HAS BEEN UPDATED!

Please continue browsing the movies!

Thank you,
MOVIELANE Accounts TEAM";

$sender = "From: mharipriya819@gmail.com";

if(mail($email, $subject, $message, $sender)){
   
} else {
    
    echo "Failed to send an email! ";
}
    
} 
        echo json_encode(['success' => true]);
        exit();
 } else {
        // Failed to update profile
        echo json_encode(['success' => false, 'error' => 'Failed to update.']);
        exit();
    }
 
?>