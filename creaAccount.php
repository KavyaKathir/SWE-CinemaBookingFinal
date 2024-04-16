<?php
session_start(); 
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "home"; 

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}


if (isset($_POST['submit'])) {
    
    if (!empty($_POST['firstName']) && !empty($_POST['lastName'])  && !empty($_POST['creEmail']) && !empty($_POST['createPwd']) && !empty($_POST['phone'])) {
       
        $firstname = $_POST['firstName'];
        $lastname = $_POST['lastName'];
        $email = $_POST['creEmail'];
        $password = password_hash($_POST['createPwd'], PASSWORD_DEFAULT);
        $optInPromo = isset($_POST['promoSelected']) ? 1 : 0;
        $phone = $_POST['phone'];
        $userTypes = 2; 
       
        $shipAddress = $_POST['shipAddress'];
        $shipCity = $_POST['shipCity'];
        $shipState = $_POST['shipState'];
        $shipCountry = $_POST['shipCountry'];
        $shipZip = $_POST['shipZip'];
           
            $verificationCode = rand(100000, 999999); // Generate a 6-digit random code
            
            $account_id = uniqid();
        $status="inactive";
            
            $stmt = $conn->prepare("INSERT INTO users (userType, firstName, lastName, email, password, phoneNumber, code,status,optInPromo,accountID) VALUES (?, ?,?, ?, ?,?, ?,?, ?,?)");
            $stmt->execute([$userTypes,$firstname,$lastname,$email, $password, $phone, $verificationCode,$status,$optInPromo,$account_id]);
            $userID = $conn->lastInsertId();

            $stmt = $conn->prepare("INSERT INTO home_address (userID, street, city, state, Country, zipCode) 
                                    VALUES (?, ?, ?, ?,?, ?)");

            $stmt->execute([$userID, $shipAddress, $shipCity, $shipState,$shipCountry, $shipZip]);
            
$sql = "INSERT INTO payment_card (cardNumber, billingStreet, billingCity, billingState, billingCountry, billingZipCode,  expirationDate, cardType,userID) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

$cards = [
    [
        'cardType' => $_POST["creDeb1"],
        'cardNum' => $_POST["cardNum1"],
        'cardExp' => $_POST["exp1"],
        'cardBillAdd' => $_POST["billAdd1"],
        'cardBillCity' => $_POST["billAddCity1"],
        'cardBillState' => $_POST["billAddState1"],
        'cardBillCountry' => $_POST["billAddCtry1"],
        'cardBillZip' => $_POST["billAddZip1"]
    ],
    [
        'cardType' => $_POST["creDeb2"],
        'cardNum' => $_POST["cardNum2"],
        'cardExp' => $_POST["exp2"],
        'cardBillAdd' => $_POST["billAdd2"],
        'cardBillCity' => $_POST["billAddCity2"],
        'cardBillState' => $_POST["billAddState2"],
        'cardBillCountry' => $_POST["billAddCtry2"],
        'cardBillZip' => $_POST["billAddZip2"]
    ],
    [
        'cardType' => $_POST["creDeb3"],
        'cardNum' => $_POST["cardNum3"],
        'cardExp' => $_POST["exp3"],
        'cardBillAdd' => $_POST["billAdd3"],
        'cardBillCity' => $_POST["billAddCity3"],
        'cardBillState' => $_POST["billAddState3"],
        'cardBillCountry' => $_POST["billAddCtry3"],
        'cardBillZip' => $_POST["billAddZip3"]
    ]
];
$encryptionKey = 'ceb1234'; 
foreach ($cards as $card) {
    if (array_search("", $card) === false) {
        $encryptedCardNum=null;
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'xxxxxxxxxxxxxxxxxxxxxxxx';
        $secret_iv = 'xxxxxxxxxxxxxxxxxxxxxxxxx';
        
        $key = hash('sha256', $secret_key);    
        
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        
        $encryptedCardNum = openssl_encrypt($card['cardNum'], $encrypt_method, $key, 0, $iv);
        $encryptedCardNum = base64_encode($encryptedCardNum);
        
        
        $encryptedExp = openssl_encrypt($card['cardExp'], $encrypt_method, $key, 0, $iv);
$encryptedExp=base64_encode($encryptedExp);
        try {
            
            $stmt->bindParam(1, $encryptedCardNum, PDO::PARAM_STR);
            $stmt->bindParam(2, $card['cardBillAdd'], PDO::PARAM_STR);
            $stmt->bindParam(3, $card['cardBillCity'], PDO::PARAM_STR);
            $stmt->bindParam(4, $card['cardBillState'], PDO::PARAM_STR);
            $stmt->bindParam(5, $card['cardBillCountry'], PDO::PARAM_STR);
            $stmt->bindParam(6, $card['cardBillZip'], PDO::PARAM_INT);
            $stmt->bindParam(7, $encryptedExp, PDO::PARAM_STR);
            $stmt->bindParam(8, $card['cardType'], PDO::PARAM_STR);
            $stmt->bindParam(9, $userID, PDO::PARAM_INT);

            $stmt->execute();
        } catch(PDOException $e) {
            die("Error inserting card details: " . $e->getMessage());
        }
    }
}

            $subject = "Your MOVIELANE Verification Code";
            $message = "Hi $firstname ,
            
Here is your verification code:  $verificationCode . Please use this code to verify your account!
            
Thank you,
MOVIELANE Accounts Team";

            $sender = "From: MOVIELANE BOOKING";
            
            if(mail($email, $subject, $message, $sender)){
                $info = "We've sent a verification code to your email - $email Please check your email!";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                header("Location: user-otp.php" );
                exit();
            }else{
                $errors['otp-error'] = "Failed while sending code!";
            }
        
    }}
?>



